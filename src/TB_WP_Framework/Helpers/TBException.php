<?php

namespace TB_WP_Framework\Helpers;
if(!defined('ABSPATH')){exit;}
use Exception;
use Throwable;

/**
 * Class TBException
 * @package TB_WP_Framework\Helpers
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class TBException extends Exception {

	/**
	 * @var array
	 * @since 1.0.0
	 */
	private $data;
	// Redefine the exception so message isn't optional

	/**
	 * @param $message
	 * @param int $code
	 * @param array $data
	 * @param \Throwable|null $previous
	 */
	public function __construct($message, $code = 0,array $data = [], Throwable $previous = null) {
		// some code

		// make sure everything is assigned properly
		parent::__construct($message, $code, $previous);
		$this->data = $data;
	}

	// custom string representation of object

	/**
	 * @return string
	 * @since 1.0.0
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	/**
	 * @return array
	 * @since 1.0.0
	 */
	public function getData(): array {
		return $this->data;
	}
}