<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;


class Enqueue extends BaseController
{

    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }


    function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_style('mystyle', $this->plugin_url . 'assets/mystyle.css');
        wp_enqueue_style('checkbox', $this->plugin_url . 'assets/scss/checkbox/checkbox.css');
        wp_enqueue_style('table', $this->plugin_url . 'assets/scss/table/table.css');
        wp_enqueue_style('tabs', $this->plugin_url . 'assets/scss/tabs/tabs.css');
        wp_enqueue_style('form', $this->plugin_url . 'assets/scss/form/form.css');
        wp_enqueue_script('myscript', $this->plugin_url . 'assets/myscript.js');
    }
}
