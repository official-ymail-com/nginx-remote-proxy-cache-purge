<?php
/*
Plugin Name: Nginx Remote Proxy Cache Purge
Description: Purge remote proxy cache
Version: 1.0
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'VERSION_nrpcp_PLUGIN',  '1.0');
define( 'PATH_nrpcp_PLUGIN',  plugin_dir_path( __FILE__ ));
define( 'URL_nrpcp_PLUGIN',  plugins_url('', __FILE__));

if(!defined('nrpcp_secret')){
	define( 'nrpcp_secret',  'Nginx Remote Proxy Cache Purge Secrete');
}
if(!defined('nrpcp_purge_folder')){
	define( 'nrpcp_purge_folder',  'purge');
}

require_once(PATH_nrpcp_PLUGIN . 'class/nrpcp.class.php');
add_action( 'plugins_loaded', array( 'nrpcp_class', 'init' ) );