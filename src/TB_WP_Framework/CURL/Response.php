<?php

namespace TB_WP_Framework\CURL;
if(!defined('ABSPATH')){exit;}

/**
 * Class Response
 * @package TB_WP_Framework\CURL
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class Response {

	/**
	 * @var mixed|null
	 * @since 1.0.0
	 */
	private $response;
	/**
	 * @var mixed|null
	 * @since 1.0.0
	 */
	private $httpcode;
	/**
	 * @var mixed|null
	 * @since 1.0.0
	 */
	private $responseOBJ;

	/**
	 * @param null $httpcode
	 * @param null $response
	 * @param null $responseOBJ
	 */
	public function __construct($httpcode = null,$response = null,$responseOBJ = null) {
		$this->httpcode = $httpcode;
		$this->response = $response;
		$this->responseOBJ = $responseOBJ;
	}

	/**
	 * @param mixed|null $response
	 */
	public function setResponse( $response ): void {
		$this->response = $response;
	}

	/**
	 * @param mixed|null $httpcode
	 */
	public function setHttpcode( $httpcode ): void {
		$this->httpcode = $httpcode;
	}

	/**
	 * @param mixed|null $responseOBJ
	 */
	public function setResponseOBJ( $responseOBJ ): void {
		$this->responseOBJ = $responseOBJ;
	}

	/**
	 * @return mixed|null
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @return mixed|null
	 */
	public function getHttpcode() {
		return $this->httpcode;
	}

	/**
	 * @return mixed|null
	 */
	public function getResponseOBJ() {
		return $this->responseOBJ;
	}
}