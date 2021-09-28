<?php
/**
 * 10bit WordPress Framework
 *
 * PHP version 7
 * @package TB_WP_FrameWork
 * @license https://opensource.org/licenses/mit-license.php MIT
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 * @version 1.0.0
 * @link https://github.com/10bitOfficial/TB_WP_Framework at GitHub
 */

namespace TB_WP_Framework;

if(!defined('ABSPATH')){exit;}

/**
 * Define framework DIR PATH Constant
 */
define('TB_WP_Framework_DIR_PATH',plugin_dir_path( __FILE__ ));
/**
 * Define framework DIR URL Constant
 */
define('TB_WP_Framework_DIR_URL',plugin_dir_url( __FILE__ ));

/**
 * Class TB_WP_Framework
 * @package TB_WP_Framework
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class TB_WP_Framework {

	/**
	 * Fire start the framework!
	 */
	public function __construct() {
		$this->load();
	}

	/**
	 * Loads all necessary files
	 * @license 1.0.0
	 */
	public function load(){
		$this->loadVendors();
		$this->loadHelpers();
		$this->loadAPI();
		$this->loadHooks();
		$this->loadWPSettings();
	}

	/**
	 * @since 1.0.0
	 */
	public function loadVendors(){
		require_once 'vendor/autoload.php';
	}

	/**
	 * @since 1.0.0
	 */
	public function loadHelpers(){
		require_once 'Helpers/Helpers.php';
	}

	/**
	 * @since 1.0.0
	 */
	public function loadAPI(){
		require_once 'API/API.php';
	}

	/**
	 * @since 1.0.0
	 */
	public function loadHooks(){
		require_once 'Hooks/Hooks.php';
	}

	/**
	 * @since 1.0.0
	 */
	public function loadWPSettings(){
		require_once 'WP_Settings/WP_Settings.php';
	}
}