<?php
/**
 * Assets
 * @package nginx-remote-proxy-cache-purge
 */
 
class nrpcp_assets_class{
	 
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}
	
	public static function init_hooks() {
		self::$initiated = true;
		add_action( 'wp_enqueue_scripts', array('nrpcp_assets_class', 'wp_enqueue_scripts'), 11 );
	}
	 
	 /**
	 * Enqueue JS/CSS files
	 */
	public static function wp_enqueue_scripts(){
		if(is_admin_bar_showing()){
			$current_url = home_url($_SERVER['REQUEST_URI']);
			wp_register_script( 'nrpcp-js', URL_nrpcp_PLUGIN . '/assets/js/nrpcp.js', array('jquery'), VERSION_nrpcp_PLUGIN, $in_footer );
			wp_localize_script( 'nrpcp-js', 'nrpcp_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'current_url' => $current_url,
			));
			
			wp_enqueue_script( 'nrpcp-js' );
		}
	}
 }