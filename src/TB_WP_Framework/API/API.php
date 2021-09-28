<?php

namespace TB_WP_Framework\API;
if(!defined('ABSPATH')){exit;}
require_once 'Response.php';
use WP_HTTP_Requests_Response;
use function wp_remote_get;

/**
 * Class API
 * @package TB_WP_Framework\API
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class API {

	public $url;
	public $params;

	/**
	 * @param string $url
	 * @param array $args
	 *
	 * @return \WP_HTTP_Requests_Response
	 * @since 1.0.0
	 */
	public function GET(string $url,array $args=[]): WP_HTTP_Requests_Response{
		$response = wp_remote_get($url,$args);
		return $response['http_response'];
	}

	/**
	 * @param string $url
	 * @param array $args
	 *
	 * @return Response
	 * @since 1.0.0
	 */
	public function jsonGET(string $url, array $args=[]): Response {
		$response = self::GET($url,$args);
		return new Response($response->get_status(),$response->get_data(),json_decode($response->get_data()));
	}

	/**
	 * @param string $url
	 * @param mixed $body
	 * @param array $args
	 *
	 * @return \WP_HTTP_Requests_Response
	 * @since 1.0.0
	 */
	public function POST(string $url, $body=false,array $args=[]):WP_HTTP_Requests_Response{
		if ($body)
			$args['body'] = $body;
		$response = wp_remote_post($url,$args);
		return $response['http_response'];
	}

	/**
	 * @param string $url
	 * @param mixed $body
	 * @param array $args
	 *
	 * @return \TB_WP_Framework\API\Response
	 * @since 1.0.0
	 */
	public function jsonPOST(string $url, $body=false, array $args=[]): Response {
		$response = self::POST($url,$body,$args);
		return new Response($response->get_status(),$response->get_data(),json_decode($response->get_data()));
	}

}