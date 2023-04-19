<?php
/*
Plugin Name: Radikal ACF
Description: Presets of Advanced Customs Fields
Version: 1.0.0
Author: Radikal
Author URI: http://www.radikal.io/
Plugin URI: http://www.radikal.io/
License: MIT License
License URI: http://opensource.org/licenses/MIT
Text Domain: radikal-acf
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Radikal ACF class.
 *
 * @class Radikal_ACF
 * @version	1.0.0
 */


class Radikal_ACF {

	/**
	 * @var $defaults
	 */
	private $defaults = array(
		'general' => array(
		),
		'version'	=> '1.0.0'
    );
    
    private static $_instance;

	private function __clone() {}
	private function __wakeup() {}

	/**
	 * Main plugin instance.
	 * 
	 * @return object
	 */
	public static function instance() {

		if ( self::$_instance === null ) {
			self::$_instance = new self();

			self::$_instance->includes();
        }

		return self::$_instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
		
		// get options
        $options = get_option( 'radikal_acf_options', $this->defaults['general'] );
	}
	
    


    /**
     * Triggered when activating the plugin
     * 
     * @return void
     */
	public function activation() {
		error_log('Activating the plugin');

		rad_acf_injectACFGroups();
	}



	/**
     * Triggered when deactivating the plugin
     * 
     * @return void
     */
	public function deactivation() {
		error_log('Deactivating the plugin');
	}


	
	/**
	 * Include required files
	 *
	 * @return void
	 */
	private function includes() {
		include_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'includes/options.php' );
	}

}

/**
 * Initialize Radikal ACF
 */
function Radikal_ACF() {
	static $instance;

	// first call to instance() initializes the plugin
	if ( $instance === null || ! ( $instance instanceof Radikal_ACF ) )
		$instance = Radikal_ACF::instance();

	return $instance;
}

$radikal_acf = Radikal_ACF();
