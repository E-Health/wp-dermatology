<?php
/**
 * Plugin Name: WP Dermatology
 * Plugin URI:  http://dermatologist.co.in/wp-dermatology
 * Description: A plugin for dermatology bloggers and clinic owners!
 * Version:     0.0.1
 * Author:      Bell Eapen
 * Author URI:  http://nuchange.ca/ehealth-resume
 * Donate link: http://dermatologist.co.in/wp-dermatology
 * License:     GPLv2
 * Text Domain: wp-dermatology
 * Domain Path: /languages
 *
 * @link http://dermatologist.co.in/wp-dermatology
 *
 * @package WP Dermatology
 * @version 0.0.1
 */

/**
 * Copyright (c) 2016 Bell Eapen (email : wp.dermatology@gulfdoctor.net)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp
 */


// User composer autoload.
require 'vendor/autoload_52.php';

/**
 * Include other plugin classes.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dermbase.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-peelscore.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-tascderm.php';


/**
 * Main initiation class
 *
 * @since  NEXT
 */
final class WP_Dermatology {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  NEXT
	 */
	const VERSION = '0.0.1';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  NEXT
	 */
	protected $basename = '';

	/**
	 * Singleton instance of plugin
	 *
	 * @var WP_Dermatology
	 * @since  NEXT
	 */
	protected static $single_instance = null;

	/**
	 * Instance of WPD_Dermbase
	 *
	 * @since NEXT
	 * @var WPD_Dermbase
	 */
	protected $dermbase;

	/**
	 * Instance of WPD_Peelscore
	 *
	 * @since NEXT
	 * @var WPD_Peelscore
	 */
	protected $peelscore;

	/**
	 * Instance of WPD_Tascderm
	 *
	 * @since NEXT
	 * @var WPD_Tascderm
	 */
	protected $tascderm;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  NEXT
	 * @return WP_Dermatology A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  NEXT
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		$this->dermbase = new WPD_Dermbase( $this );
		$this->peelscore = new WPD_Peelscore( $this );
		$this->tascderm = new WPD_Tascderm( $this );
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {

		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Activate the plugin
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _activate() {
		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function _deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function init() {
        // If this file is called directly, abort.
        if ( ! defined( 'WPINC' ) ) {
            die;
        }
		if ( $this->check_requirements() ) {
			load_plugin_textdomain( 'wp-dermatology', false, dirname( $this->basename ) . '/languages/' );
			$this->plugin_classes();
		}
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since  NEXT
	 * @return boolean result of meets_requirements
	 */
	public function check_requirements() {
		if ( ! $this->meets_requirements() ) {

			// Add a dashboard notice.
			add_action( 'all_admin_notices', array( $this, 'requirements_not_met_notice' ) );

			// Deactivate our plugin.
			add_action( 'admin_init', array( $this, 'deactivate_me' ) );

			return false;
		}

		return true;
	}

	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function deactivate_me() {
		deactivate_plugins( $this->basename );
	}

	/**
	 * Check that all plugin requirements are met
	 *
	 * @since  NEXT
	 * @return boolean True if requirements are met.
	 */
	public static function meets_requirements() {
		// Do checks for required classes / functions
		// function_exists('') & class_exists('').
		// We have met all requirements.
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function requirements_not_met_notice() {
		// Output our error.
		echo '<div id="message" class="error">';
		echo '<p>' . sprintf( __( 'WP Dermatology is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'wp-dermatology' ), admin_url( 'plugins.php' ) ) . '</p>';
		echo '</div>';
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  NEXT
	 * @param string $field Field to get.
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'dermbase':
			case 'peelscore':
			case 'tascderm':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}
}

/**
 * Grab the WP_Dermatology object and return it.
 * Wrapper for WP_Dermatology::get_instance()
 *
 * @since  NEXT
 * @return WP_Dermatology  Singleton instance of plugin class.
 */
function wp_dermatology() {
	return WP_Dermatology::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( wp_dermatology(), 'hooks' ) );

register_activation_hook( __FILE__, array( wp_dermatology(), '_activate' ) );
register_deactivation_hook( __FILE__, array( wp_dermatology(), '_deactivate' ) );
