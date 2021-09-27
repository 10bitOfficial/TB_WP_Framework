<?php

namespace TB_WP_Framework\Helpers;
if(!defined('ABSPATH')){exit;}
require_once ('TBException.php');
require_once ('PluginData.php');
require_once ('Debug.php');
require_once ('RegexParser.php');

/**
 * Class Helpers
 * @package TB_WP_Framework\Helpers
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class Helpers {
	/**
	 * @since 1.0.0
	 */
	static function pluginWcDependencies(){
			$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';
			if (!(in_array( $plugin_path, wp_get_active_and_valid_plugins() )
			      || in_array( $plugin_path, wp_get_active_network_plugins() ))) {
				wp_die( __( 'This plugin requires WooCommerce to be installed and activated.  Sorry about that.', 'massms' ) );
			}
	}
}
