<?php
/*
Plugin Name: Nginx Remote Proxy Cache Purge
Description: Purge remote proxy cache
Version: 1.0
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'VERSION_NRPCP_PLUGIN',  '1.0');
define( 'PATH_NRPCP_PLUGIN',  plugin_dir_path( __FILE__ ));
define( 'URL_NRPCP_PLUGIN',  plugins_url('', __FILE__));

require_once(PATH_NRPCP_PLUGIN . 'class/nrpcp.class.php');
add_action( 'plugins_loaded', array( 'nrpcp_class', 'init' ) );