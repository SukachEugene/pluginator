<?php
/*
Plugin Name: Local Debugger
Descripdion: Local debugging stuff for help by Highrise
*/

/**
 * Enchanced debugging function which formats debug info and allows for a label
 * 
 * @param mixed $data    The data to dump
 * @param string $label  A label to apply before the data
 * @return mixed         The dump and the label if present
 */

 function wp_var_dump ( $data, $label = '') {

    echo '<div style="background-color: #f2f2f2; padding: 12px; margin-left: 20vw;">';

    /* Check whether we have been provided with a label */
    if ( ! empty($label)) {
        /* output our label as a heading */
        echo '<h2>' . $label . '</h2>';
    }

    /* output the normal var_dump wrapped in <pre> formatting */
    echo '<pre>';
    var_dump($data);
    echo '</pre></div>';
    return;

 }

 /**
  * Write to log file in wp-content/debug.log
  */
if ( ! function_exists('hd_write_log')) {

    function hd_write_log ($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}