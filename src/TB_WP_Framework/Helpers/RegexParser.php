<?php

namespace TB_WP_Framework\Helpers;
if(!defined('ABSPATH')){exit;}

/**
 * Class RegexParser
 * @package TB_WP_Framework\Helpers
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class RegexParser {

	/**
	 *
	 */
	const PARSER_SHORTCODE = '/([^{{]+)\::([^}}]+)/';
	/**
	 *
	 */
	const PARSER_SHORTCODE_CONTENT = '/\{{([^}]+)\}}/m';
	/**
	 *
	 */
	const PARSER_SHORTCODE_TYPE = '/([^ ]+)\::([^ ]+)/g';

	/**
	 * @param string $string
	 * @param array $sources
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function inBetweenCurlyBraces(string $string, array $sources): string {
        $matches = self::matchAll(self::PARSER_SHORTCODE,$string);
        if (!$matches) return $string;
        return self::ReplaceData($matches,$sources, $string);
	}

	/**
	 * @param string $regex
	 * @param string $string
	 *
	 * @return false|mixed
	 * @since 1.0.0
	 */
	public static function matchAll(string $regex,string $string){
		$hasMatch = preg_match_all($regex,$string,$matches, PREG_SET_ORDER, 0);
		if (!$hasMatch)
			return false;
		return $matches;
	}

	/**
	 * @example
			array(3) {
			[0]=>
			string(28) "WC_Order::billing_first_name"
			[1]=>
			string(8) "WC_Order"
			[2]=>
			string(18) "billing_first_name"
			}
	 *
	 * @param array $matches
	 * @param array $sources
	 * @param string $string
	 *
	 * @return string
	 */

	public static function ReplaceData( array $matches, array $sources,string $string ): string {
		$data = [];
		foreach ($matches as $match){
			switch ($match[1]){
				case 'WC_Order':
					$function = 'get_'.$match[2];
					$data ['replace'][] = $sources['WC_Order']->$function();
					break;
				case 'WP_User':
					$data ['replace'][] = $sources['WP_User']?$sources['WP_User']->{$match[2]}:'guest';
			}
			$data ['shortcode'][] = "/{{".$match[0]."}}/";

		}
		return preg_replace($data['shortcode'],$data['replace'],$string);
	}

	/**
	 * @since 1.0.0
	 */
	public static function mapShortcode(){

	}
}