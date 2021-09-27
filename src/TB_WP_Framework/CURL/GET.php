<?php

namespace TB_WP_Framework\CURL;
if(!defined('ABSPATH')){exit;}

/**
 * Class GET
 * @package TB_WP_Framework\CURL
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class GET{
	/**
	 * @param $url
	 *
	 * @return \TB_WP_Framework\CURL\Response
	 * @since 1.0.0
	 */
	static function CurlGET($url): Response {
		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'GET',
			CURLOPT_HTTPHEADER     => array(),
		) );

		$response = curl_exec( $curl );
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close( $curl );
        $responseOBJ = ($response)?json_decode($response):null;
		return new Response($httpcode,$response,$responseOBJ);
	}
}