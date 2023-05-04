<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class CustomPostTypeController extends BaseController
{

    public $settings;
    public $callbacks;
    public $subpages = array();

    public function register()
    {
        $option = get_option('eugene_plugin');
     
        // $activated = isset($option['cpt_manager']) ? $option['cpt_manager'] : false;

        if ( ! $this->activated('cpt_manager')) {
            return;
        }

        $this->settings = new SettingsApi;

        $this->callbacks = new AdminCallbacks;

        $this->setSubpages();

        $this->settings->addSubPages($this->subpages)->register();

        add_action('init', array($this, 'activate'));
    }

    public function setSubPages()
   {

      $this->subpages = array(
         array(
            'parent_slug' => 'eugene_plugin',
            'page_title'  => 'Custom Post Types',
            'menu_title'  => 'CPT Manager',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_cpt',
            'callback'    => array($this->callbacks, 'adminCpt'),
         )
      );
   }

    public function activate()
    {
        register_post_type(
            'eugene_products',
            array(
                'labels'      => array(
                    'name'           => 'Products',
                    'singular_name'  => 'Product',

                ),
                'public'      => true,
                'has_archive' => true,

            )

        );
    }
}
