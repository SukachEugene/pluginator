<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class ChatController extends BaseController
{

    public $settings;
    public $callbacks;
    public $subpages = array();

    public function register()
    {

        if ( ! $this->activated('chat_manager')) {
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
            'page_title'  => 'Chat Manager',
            'menu_title'  => 'Chat Manager',
            'capability'  => 'manage_options',
            'menu_slug'   => 'eugene_chat',
            'callback'    => array($this->callbacks, 'adminChat'),
         )
      );
   }

}
