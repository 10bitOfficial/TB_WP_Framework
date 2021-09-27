<?php

namespace TB_WP_Framework\Helpers;
if(!defined('ABSPATH')){exit;}

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Log\LogLevel;

/**
 * Class Debug
 * @package TB_WP_Framework\Helpers
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class Debug {

	/**
	 * @var \Monolog\Logger
	 * @since 1.0.0
	 */
	private $log;

	/**
	 * @param string $prefix
	 * @param string $logger
	 */
	public function __construct($prefix='TBWP',$logger='general') {
		$upload_dir = wp_upload_dir();
		$this->log = new Logger($logger);
		$streamFile = new RotatingFileHandler($upload_dir['basedir']."/{$prefix}-logs/$prefix.log",7);
		$streamChrome = new ChromePHPHandler(Logger::DEBUG);
		$dateFormat = "H:i:s";
		$fileLineFormatter = new LineFormatter("[%datetime%][%level_name%]: %message% %context% %extra%\n",$dateFormat);
		$processor = new PsrLogMessageProcessor(null,true);
		$streamFile->setFormatter($fileLineFormatter);
		$this->log->pushHandler($streamFile);
		$this->log->pushHandler($streamChrome);
		$this->log->pushProcessor($processor);
	}

	/**
	 * Adds a log record at an arbitrary level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param int|string $level   The log level
	 * @param string $message The log message
	 * @param mixed[]    $context The log context
	 *
	 * @phpstan-param Level|LevelName|LogLevel::* $level
	 */
	public function log($level, string $message, array $context = []): void {
		$this->log->log($level, $message, $context);
	}

	/**
	 * Adds a log record at the DEBUG level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function debug( string $message, array $context = []): void {
		$this->log->debug($message,$context);
	}

	/**
	 * Adds a log record at the INFO level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string  $message The log message
	 * @param mixed[] $context The log context
	 */
	public function info($message, array $context = []): void {
		$this->log->info($message,$context);
	}

	/**
	 * Adds a log record at the NOTICE level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function notice( string $message, array $context = []): void {
		$this->log->notice($message,$context);
	}

	/**
	 * Adds a log record at the WARNING level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function warning( string $message, array $context = []): void {
		$this->log->warning($message,$context);
	}

	/**
	 * Adds a log record at the ERROR level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function error( string $message, array $context = []): void {
		$this->log->error($message,$context);
	}

	/**
	 * Adds a log record at the CRITICAL level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function critical( string $message, array $context = []): void {
		$this->log->critical($message,$context);
	}

	/**
	 * Adds a log record at the ALERT level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function alert( string $message, array $context = []): void {
		$this->log->alert($message,$context);
	}

	/**
	 * Adds a log record at the EMERGENCY level.
	 *
	 * This method allows for compatibility with common interfaces.
	 *
	 * @param string $message The log message
	 * @param mixed[] $context The log context
	 */
	public function emergency( string $message, array $context = []): void {
		$this->log->emergency($message,$context);
	}

	/**
	 * @param \TB_WP_Framework\Helpers\TBException $e
	 *
	 * @since 1.0.0
	 */
	public function exception(TBException $e): void {
		$this->log($e->getCode(),$e->getMessage(),['data'=>$e->getData(),'trace' => $e->getTrace()]);
	}

	/**
	 * @param string $message
	 * @param array $context
	 *
	 * @since 1.0.0
	 */
	public static function tbDebug(string $message, array $context = []){
        $logger = new self();
        $logger->debug($message,$context);
    }

}
