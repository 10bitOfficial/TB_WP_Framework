<?php

namespace TB_WP_Framework\WP_Settings;
if(!defined('ABSPATH')){exit;}

/**
 * Class SubMenuPage
 * @package TB_WP_Framework\WP_Settings
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class SubMenuPage{
	static public $pageTitle;
	static public $menuTitle;
	static public $menuSlug;
	static public $callBack;
	static public $position;

	/**
	 * @return bool
	 * @since 1.0.0
	 */
	static public function isValid(): bool {
		if (self::$pageTitle && self::$menuTitle && self::$callBack) return true;
		return false;
	}

	/**
	 * @param string $pageTitle
	 * @param string $menuTitle
	 * @param $callBack
	 * @param string|null $menuSlug
	 * @param int|null $position
	 *
	 * @since 1.0.0
	 */
	static public function set(string $pageTitle,string $menuTitle,$callBack,?string $menuSlug,?int $position){
		self::$pageTitle = $pageTitle;
		self::$menuTitle = $menuTitle;
		self::$menuSlug = $menuSlug;
		self::$callBack = $callBack;
		self::$position = $position;
	}
}
