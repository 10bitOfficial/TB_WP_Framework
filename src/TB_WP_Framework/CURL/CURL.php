<?php

namespace TB_WP_Framework\CURL;
if(!defined('ABSPATH')){exit;}
require_once 'Response.php';
require_once 'GET.php';
require_once 'POST.php';

/**
 * Class CURL
 * @package TB_WP_Framework\CURL
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class CURL {
	/**
	 * @param $url
	 *
	 * @return \TB_WP_Framework\CURL\Response
	 * @since 1.0.0
	 */
	static public function GET($url): Response {
		return GET::CurlGET($url);
	}

	/**
	 * @param $url
	 * @param $data
	 *
	 * @return \TB_WP_Framework\CURL\Response
	 * @since 1.0.0
	 */
	static public function POST($url,$data): Response {
		return POST::CurlPOST($url,$data);
	}
}