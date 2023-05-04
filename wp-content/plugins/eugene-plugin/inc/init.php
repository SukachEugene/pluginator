<?php

/**
 * @package EugenePlugin
 */

namespace Inc;

final class Init
{

    /**
     *  Store all the classes inside the array
     *  @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\CustomPostTypeController::class,
            Base\CustomTaxonomyController::class,
            Base\WidgetController::class,
            Base\GalleryController::class,
            Base\TestimonialController::class,
            Base\TemplatesController::class,
            Base\AuthController::class,
            Base\MembershipController::class,
            Base\ChatController::class,
        ];
    }


    /**
     * Loop through the classes, initialize them 
     * and call the register() method if it exists
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }


    /**
     * Initialize the class
     * @param class $class      class from the services array
     * @return class instance   new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class;

        return $service;
    }
}

// use Inc\Activate;
// use Inc\Deactivate;


// if (!class_exists('EugenePlugin')) {

//     class EugenePlugin
//     {

//         public $plugin_name;

//         function __construct()
//         {
//             $this->plugin_name = plugin_basename( __FILE__ );
//         }

//         function register()
//         {
//             add_action('admin_enqueue_scripts', array($this, 'enqueue'));

//             add_action('admin_menu', array( $this, 'add_admin_pages'));

//             add_filter("plugin_action_links_$this->plugin_name", array($this, 'settings_link'));
//         }

//         public function settings_link($links) {
//             $settings_link = '<a href="admin.php?page=eugene_plugin">Settings</a>';
//             array_push($links, $settings_link);
//             return $links;
//         }

//         public function add_admin_pages() {
//             add_menu_page('Eugene Plugin', 'Eugene Plugin', 'manage_options', 'eugene_plugin', array($this, 'admin_index'), 'dashicons-editor-customchar', 110 );
//         }

//         public function admin_index() {
//             require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
//         }

//         protected function create_post_type() {
// 			add_action( 'init', array( $this, 'custom_post_type' ) );
// 		}

//         function custom_post_type()
//         {
//             register_post_type('book', ['public' => true, 'label' => 'Books']);
//         }

//         function enqueue()
//         {
//             // enqueue all our scripts
//             wp_enqueue_style('mystyle', plugins_url('/assets/mystyle.css', __FILE__));
//             wp_enqueue_script('myscript', plugins_url('/assets/myscript.js', __FILE__));
//         }

//         function activate()
//         {
//             // require_once plugin_dir_path(__FILE__) . 'inc/eugene-plugin-activate.php';
//             Activate::activate();
//         }

//     }

//     if (class_exists('EugenePlugin')) {
//         $eugenePlugin = new EugenePlugin();
//         $eugenePlugin->register();
//     }

//     // activation
//     register_activation_hook(__FILE__, array($eugenePlugin, 'activate'));

//     // deactivation
//     // require_once plugin_dir_path(__FILE__) . 'inc/eugene-plugin-deactivate.php';
//     // register_deactivation_hook(__FILE__, array('Inc\Deactivate', 'deactivate'));
//     register_deactivation_hook(__FILE__, array(Deactivate::class, 'deactivate'));
    
// }