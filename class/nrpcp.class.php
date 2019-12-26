<?php
/**
 * @package nginx-remote-proxy-cache-purge
 */
 
class nrpcp_class{
	
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {
		self::$initiated = true;
		add_action( 'admin_bar_menu', array('nrpcp_class', 'admin_bar_menu'), 999);
	}

	public static function admin_bar_menu( $admin_bar ) {
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$menu = array( 
			array(
				'id'    => 'nrpcp_main',
				'parent' => null,
				'title' => __('Purge Cache', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => admin_url('admin.php?page=custom-page'),
				'meta' => [
					'title' => __( 'Nginx Remote Proxy Cache Purge', 'nrpcp' ), //This title will show on hover
				]
			),
			array(
				'id'    => 'nrpcp_purge_all',
				'parent' => 'nrpcp_main',
				'title' => __('Purge All', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => admin_url('admin.php?page=custom-page'),
				'meta' => [
					'title' => __( 'Purge all cache', 'nrpcp' ), //This title will show on hover
				]
			) ,
			array(
				'id'    => 'nrpcp_purge_page',
				'parent' => 'nrpcp_main',
				'title' => __('Purge page', 'nrpcp'), //you can use img tag with image link. it will show the image icon Instead of the title.
				'href'  => admin_url('admin.php?page=custom-page'),
				'meta' => [
					'title' => __( 'Purge this page cache', 'nrpcp' ), //This title will show on hover
				]
			) 
		);
		foreach( $menu as $args ) {
			$admin_bar->add_node( $args );
		}
	}
	
}