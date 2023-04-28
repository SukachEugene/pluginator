<?php
/**
 * This file includes all of the included files into the plugin
 */

 // load in all the required inc files
 $includes_files = glob( plugin_dir_path( __FILE__) . '*.php');

 // if we have any includes files
 if ( !empty ($includes_files)) {

    // loop through each file
    foreach ($includes_files as $include_file) {

        // if this file in the loop is this file we are now in
        if (strpos( $include_file, 'loader.php') !== false) {
            continue; // move to next file
        }

        // require this file in the plugin
        require_once ($include_file);
    }
 }