<?php

/**
 * @package EugenePlugin
 */
namespace Inc\Base;

 class Activate {
    public static function activate() {
        flush_rewrite_rules();

        $default = array();

        if ( ! get_option('eugene_plugin')) {
            update_option('eugene_plugin', $default);
        }

        // $default = array(
        //     array()
        // );

        if ( ! get_option('eugene_plugin_cpt')) {
            update_option('eugene_plugin_cpt', $default);
        }

    }
 }