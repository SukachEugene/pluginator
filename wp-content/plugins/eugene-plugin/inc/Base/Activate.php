<?php

/**
 * @package EugenePlugin
 */
namespace Inc\Base;

 class Activate {
    public static function activate() {
        flush_rewrite_rules();

        if (get_option('eugene_plugin')) {
            return;
        }

        $default = array();

        update_option('eugene_plugin', $default);
    }
 }