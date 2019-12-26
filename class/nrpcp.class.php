<?php
/**
 * @package nginx-remote-proxy-cache-purge
 */
 
class nrpcp_class{
	
	private static $initiated = false;
	
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
		add_action( 'admin_bar_menu', array('nrpcp_class', 'admin_bar_menu'), 999);
		add_action( 'wp_enqueue_scripts', array('nrpcp_class', 'wp_enqueue_scripts'), 11 );
		add_action( 'wp_ajax_purge_cache_page', array('nrpcp_class', 'purge_cache_page') );
	}
	
	 /**
	 * Add items in WordPress admin bar
	 */
	public static function admin_bar_menu( $admin_bar ) {
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$menu = array( 
			array(
				'id'    => 'nrpcp_main',
				'parent' => null,
				'title' => __('Purge Cache', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => admin_url('admin.php'),
				'meta' => [
					'title' => __( 'Nginx Remote Proxy Cache Purge', 'nrpcp' ), //This title will show on hover
				]
			),
/* 			array(
				'id'    => 'nrpcp_purge_all',
				'parent' => 'nrpcp_main',
				'title' => __('Purge All', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => admin_url('admin.php?page=custom-page'),
				'meta' => [
					'title' => __( 'Purge all cache', 'nrpcp' ), //This title will show on hover
				]
			) , */
			array(
				'id'    => 'nrpcp_purge_page',
				'parent' => 'nrpcp_main',
				'title' => __('Purge page', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => '#',
				'meta' => [
					'title' => __( 'Purge this page cache', 'nrpcp' ), //This title will show on hover
				]
			) 
		);
		foreach( $menu as $args ) {
			$admin_bar->add_node( $args );
		}
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
				'nonce'	=> wp_create_nonce( __( 'Nginx Remote Proxy Cache Purge', 'nrpcp' ) ),
				'current_url' => $current_url,
			));
			
			wp_enqueue_script( 'nrpcp-js' );
		}
	}
	
	 /**
	 * Purge page cache
	 */
	public static function purge_cache_page( $admin_bar ) {
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		check_ajax_referer( __( 'Nginx Remote Proxy Cache Purge', 'nrpcp' ) );
	}
	
}