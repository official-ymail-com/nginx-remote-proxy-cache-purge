<?php
/*
Plugin Name: Nginx Remote Proxy Cache Purge
Description: Purge remote Nginx proxy cache using http curl
Version: 1.0
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'VERSION_NRPCP_PLUGIN',  '1.0');
define( 'PATH_NRPCP_PLUGIN',  plugin_dir_path( __FILE__ ));
define( 'URL_NRPCP_PLUGIN',  plugins_url('', __FILE__));
define( 'BASENAME_NRPCP_PLUGIN',  plugin_basename(__FILE__));

require_once(PATH_NRPCP_PLUGIN . 'class/nrpcp.class.php');
require_once(PATH_NRPCP_PLUGIN . 'class/admin.class.php');
add_action( 'plugins_loaded', array( 'nrpcp_class', 'init' ) );
add_action( 'plugins_loaded', array( 'NRPCP_Admin_Class', 'init' ) );