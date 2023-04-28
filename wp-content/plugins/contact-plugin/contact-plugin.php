<?php

/**
 * 
 * Plugin Name: Contact Plugin
 * Description: My first custom plugin for create forms
 * Author: Eugene Sukach
 * Version: 1.0
 * Text Domain: options-plugin
 * 
 */

if (!defined('ABSPATH')) {
    die('What are you trying to do?');
}

if (!class_exists('ContactPlugin')) {

    class ContactPlugin
    {

        public function __construct()
        {

            // define('MY_PLUGIN_PATH', plugin_dir_url(__FILE__));

            // require_once(MY_PLUGIN_PATH . 'vendor/autoload.php');
        }

        public function initialize()
        {
        }
    }

    new ContactPlugin;
}
