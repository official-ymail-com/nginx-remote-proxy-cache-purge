<?php

class NRPCP_Admin_Class{
	
	private static $initiated = false;
	private static $proxy_server = '';
	
	/**
	* Init
	*/
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}
	
	/**
	* add actions/filters
	*/
	public static function init_hooks() {
		self::$initiated = true;
		add_action( 'admin_menu', array( 'NRPCP_Admin_Class', 'admin_menu' ) );
		add_action( 'admin_init', array( 'NRPCP_Admin_Class', 'admin_init' ) );
		add_filter( 'plugin_action_links_' . BASENAME_NRPCP_PLUGIN, array( 'NRPCP_Admin_Class', 'add_plugin_page_settings_link'));
	}
	
 
    /**
     * Registers a new settings page under Settings.
     */
    public static function admin_menu() {
        add_options_page(
            __( 'NRPCP Options', 'nrpcp' ),
            __( 'NRPCP', 'nrpcp' ),
            'manage_options',
            'options_nrpcp',
            array(
                'NRPCP_Admin_Class',
                'settings_page'
            )
        );
    }
	
    /**
     * Settings page display callback.
     */
    public static function settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'nrpcp_messages', 'nrpcp_messages', __( 'Settings Saved', 'nrpcp' ), 'updated' );
		}
	?>
	<form action="options.php" method="post">
	<?php
		settings_fields( 'options_nrpcp' );
		do_settings_sections( 'options_nrpcp' );
		submit_button( __( 'Save Settings', 'nrpcp' ) );
	?>
	</form>
	<?php
    }
	
    public static function admin_init() {
		register_setting( 'options_nrpcp', 'nrpcp-proxy-server', array(
			'type' => 'string', 
			'sanitize_callback' => 'rest_is_ip_address',
			'default' => 1,
		) );
        add_settings_section(
            'nrpcp_setting_section',
            __( 'NRPCP Setting', 'nrpcp' ),
            array('NRPCP_Admin_Class','nrpcp_setting_section_cb'),
            'options_nrpcp'
        );
		add_settings_field(
			'nrpcp-proxy-server', 
			__( 'Proxy server IP', 'nrpcp' ),
			array('NRPCP_Admin_Class', 'callback_proxy_server'),
			'options_nrpcp',
			'nrpcp_setting_section', 
			[
				'label_for' => 'nrpcp-proxy-server'
			] 
		);
	}
	
	public static function callback_proxy_server() {
		$format = '<input name="nrpcp-proxy-server" type="text" id="nrpcp-proxy-server" value="%1$s">';
		echo  sprintf($format, get_option('nrpcp-proxy-server'));
	}
	
	public static function nrpcp_setting_section_cb() {
		//do_settings_fields( 'options_nrpcp', 'nrpcp_setting_section' );
	}
	
	public static function add_plugin_page_settings_link($links) {
		$links[] = '<a href="' .
			admin_url( 'options-general.php?page=options_nrpcp' ) .
			'">' . __('Settings') . '</a>';
		return $links;
	}
}
