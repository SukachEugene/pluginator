<?php

/**
 * 
 * Plugin Name: Editable Archive Pages
 * Description: Custom plugin that allows you to manage the content on WordPress generated archive pages
 * Author: Eugene Sukach
 * Version: 0.1
 * Text Domain: editable-archive-pages
 * 
 */


 // exit if directly accessed
 if (!defined('ABSPATH')) {
    echo 'What are you trying to do?';
    exit;
}

// define variable for path to this plugin file
define( 'EAP_LOCATION', dirname( __FILE__) );
define( 'EAP_LOCATION_URL', plugins_url( '', __FILE__) );

// load in the loader file with loads everithing up
require_once( dirname( __FILE__) . '/inc/loader.php');


/**
 * Function to run when the plugin is activated
 */
function eap_activation() {

    $options = array(
        'post_types'  => array(),
        'taxonomies'  => array(),
    );

    // add an option to store the version number of this plugin
    update_option('eap_options', $options);

    // flush the sites permalink rules as we have registered post types
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'eap_activation');
 