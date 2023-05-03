<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{

   public $settings;
   public $pages = array();
   public $subpages = array();


   public function register()
   {

      $this->settings = new SettingsApi;

      $this->setPages();

      $this->setSubPages();

      $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
   }

   public function setPages() {

      $this->pages = array(
         array(
            'page_title' => 'Eugene Plugin',
            'menu_title' => 'Eugene Plugin',
            'capability' => 'manage_options',
            'menu_slug'  => 'eugene_plugin',
            'callback'   =>  function () { return require_once("$this->plugin_path/templates/admin.php");},
            'icon_url'   => 'dashicons-editor-customchar',
            'position'   => 110
         )

      );
   }

   public function setSubPages(){

      $this->subpages = array(
         array(
            'parent_slug' => 'eugene_plugin',
            'page_title'  => 'Custom Post Types',
            'menu_title'  => 'CPT',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_cpt',
            'callback'    => function () {
               echo '<h1>CPT Manager</h1>';
            },
         ),

         array(
            'parent_slug' => 'eugene_plugin',
            'page_title'  => 'Custom Taxonomies',
            'menu_title'  => 'Taxonomies',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_taxonomies',
            'callback'    => function () {
               echo '<h1>Taxonomies Manager</h1>';
            },
         ),

         array(
            'parent_slug' => 'eugene_plugin',
            'page_title'  => 'Custom Widgets',
            'menu_title'  => 'Widgets',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_widgets',
            'callback'    => function () {
               echo '<h1>Widgets Manager</h1>';
            },
         ),
      );

   }
}
