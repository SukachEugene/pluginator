<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class CustomTaxonomyController extends BaseController
{

    public $settings;
    public $callbacks;
    public $subpages = array();

    public function register()
    {

        if ( ! $this->activated('taxonomy_manager')) {
            return;
        }

        $this->settings = new SettingsApi;

        $this->callbacks = new AdminCallbacks;

        $this->setSubpages();

        $this->settings->addSubPages($this->subpages)->register();

    }

    public function setSubPages()
   {

      $this->subpages = array(
         array(
            'parent_slug' => 'eugene_plugin',
            'page_title'  => 'Custom Taxonomies',
            'menu_title'  => 'Taxonomy Manager',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_taxonomy',
            'callback'    => array($this->callbacks, 'adminTaxonomy'),
         )
      );
   }

}
