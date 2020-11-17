<?php
/*
Plugin Name: Blahbox
Plugin URI: https://wordpress.org/plugins/blahbox/#installation
Description: Blahbox
Version: 1.1.1
Author: Blahbox
Author URI: https://blahbox.net
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * Security Check
 *
 * @since 1.0
 **/

defined( 'ABSPATH' ) || die( 'Direct access to this file is forbidden.' );


/**
 * Blahbox class
 *
 * @since 1.0
 **/

class Blahbox {

	/**
	 * Starter defines and vars for use later
	 *
	 * @since 1.0
	 **/

	// Holds option data.
	var $option_name = 'pwl_blahbox_options';
	var $options = array();
	var $option_defaults;

	// DB version, for schema upgrades.
	var $db_version = 1;

	// Instance
	static $instance;


	/**
	 * Constuct
	 * Fires when class is constructed, adds init hook
	 *
	 * @since 1.0
	 **/

	function __construct() {

		// Allow this instance to be called from outside the class
		self::$instance = $this;

		// Add frontend wp_head hook
		add_action( 'wp_head',    array( &$this, 'wp_head' ) );

		// Add admin init hook
		add_action( 'admin_init', array( &$this, 'admin_init' ) );

		// Add admin panel
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );

		// Setting plugin defaults here
		$this->option_defaults = array(
			'widget_id'  => '',
			'db_version' => $this->db_version,
		);

	}


	/**
	 * Frontend wp_head Callback
	 *
	 * @since 1.0
	 **/

	function wp_head() {

		// Get options
		$this->options = wp_parse_args( get_option( 'blahbox_options' ), $this->option_defaults );

		if ( isset ( $this->options[ 'widget_id' ] ) ) {

            $this->options[ 'widget_id' ] = esc_attr( $this->options[ 'widget_id' ] );
            
            echo '<script> (function(b,c){var e=document.createElement("link");e.rel="stylesheet",e.href="https://chatboxlive.blahbox.net/static/css/main.css",document.getElementsByTagName("head")[0].appendChild(e); var f=document.createElement("script");f.onload=function(){var g;if(c)g="previewInit";else{var h=document.createElement("div");g="cbinit",h.id="cbinit",document.body.append(h)} console.log(document.querySelector("#"+g)),chatbox.initChat(document.querySelector("#"+g),b,c)},f.src="https://chatboxlive.blahbox.net/static/js/chat-lib.js",document.getElementsByTagName("head")[0].appendChild(f)}) ("' . $this->options[ 'widget_id' ] . '", 0); </script>';

		}
	
	}
	
	/**
	 * Admin init Callback
	 *
	 * @since 1.0
	 **/

	function admin_init() {

		// Fetch and set up options.
		$this->options = wp_parse_args( get_option( 'blahbox_options' ), $this->option_defaults );

		// Register Settings
		$this::register_settings();

	}


	/**
	 * Admin Menu Callback
	 *
	 * @since 1.0
	 **/

	function admin_menu() {

		// Add settings page on Tools
		add_management_page( __('Blahbox'), __('Blahbox'), 'manage_options', 'blahbox-settings', array( &$this, 'blahbox_settings' ) );

	}


	/**
	 * Register Admin Settings
	 *
	 * @since 1.0
	 **/

	function register_settings() {

		register_setting( 'blahbox', 'blahbox_options', array( $this, 'blahbox_sanitize' ) );

		// The main section
		add_settings_section( 'blahbox_settings_section', 'Blahbox Settings', array( &$this, 'blahbox_settings_callback'), 'blahbox-settings' );

		// The Fields
		add_settings_field( 'widget_id', 'Blahbox Chat ID', array( &$this, 'widget_id_callback'), 'blahbox-settings', 'blahbox_settings_section' );

	}


	/**
	 * Settings Callback
	 *
	 * @since 1.0
	 **/

	function blahbox_settings_callback() {}


	/**
	 * Widget ID Statuses Callback
	 *
	 * @since 1.0
	 **/

	function widget_id_callback() {
	?>

		<input type="input" id="blahbox_options[widget_id]" name="blahbox_options[widget_id]" value="<?php esc_attr_e( $this->options['widget_id'] ); ?>" >
		<label for="blahbox_options[widget_id]"><?php _e('Add your Chat ID to enable Blahbox', 'blahbox'); ?></label>

	<?php
	}


	/**
	 * Call settings page
	 *
	 * @since 1.0
	 **/

	function blahbox_settings() { 
	?>

		<div class="wrap">

			<h2><?php _e( 'Blahbox', 'blahbox' ); ?></h2>

			<form action="options.php" method="POST">
				<?php 
				settings_fields( 'blahbox' );
				do_settings_sections( 'blahbox-settings' );
				submit_button();
				?>
			</form>

		</div>

	<?php
	}


	/**
	 * Options sanitization and validation
	 *
	 * @param $input the input to be sanitized
	 * @since 1.0
	 **/
	function blahbox_sanitize( $input ) {

		$options = $this->options;

		$input[ 'db_version' ] = $this->db_version;

		foreach ( $options as $key => $value ) {
			$output[$key] = sanitize_text_field( $input[ $key ] );
		}

		return $output;

	}


	/**
	 * Add settings link on plugin
	 *
	 * @since 1.0
	 **/

	function add_settings_link( $links, $file ) {

		if ( plugin_basename( __FILE__ ) == $file ) {

			$settings_link = '<a href="' . admin_url( 'tools.php?page=blahbox-settings' ) .'">' . __( 'Settings', 'blahbox' ) . '</a>';
			array_unshift( $links, $settings_link );

		}

		return $links;

	}

}

new Blahbox();
