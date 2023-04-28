<?php

/**
 * 
 * Plugin Name: My Form
 * Description: My first custom plugin for create forms
 * Author: Eugene Sukach
 * Version: 1.0
 * Text Domain: my-form
 * 
 */

if (!defined('ABSPATH')) {
    echo 'What are you trying to do?';
    exit;
}

if (!class_exists('myForm')) {

    class MyForm
    {

        public function __construct()
        {

            
            // Create custom post type
            add_action('init', array($this, 'create_custom_post_type'));

            // Add assets (js, css, etc)
            add_action('wp_enqueue_scripts', array($this, 'load_assets'));

            // Add shortcode
            add_shortcode('my-form', array($this, 'load_shortcode'));

            // Load JavaScript
            add_action('wp_footer', array($this, 'load_scripts'));

            // Register REST API
            add_action('rest_api_init', array($this, 'register_rest_api'));
        }


        public function create_custom_post_type()
        {
            $args = array(
                'public' => true,
                'has_archive' => true,
                'supports' => array('title', 'test'),
                'exclude_from_search' => true,
                'public_queryable' => false,
                'capability' => 'manage_options',
                'labels' => array(
                    'name' => 'My Form',
                    'singular_name' => 'My Form Entry'
                ),
                'menu_icon' => 'dashicons-media-text',



                'register_meta_box_cb' => array($this, 'add_custom_meta_box')



            );

            register_post_type('my_form', $args);
        }


        

        public function add_custom_meta_box($post)
        {
            add_meta_box(
                'custom_meta_box',
                'Custom Field',
                array($this, 'render_custom_meta_box'),
                'my_form',
                'normal',
                'high',
                array(
                    'collapse' => false,
                )
            );
        }

        public function render_custom_meta_box($post)
        {
            $field_value = get_post_meta($post->ID, 'my_custom_field', true);
    
            echo '<label for="my_custom_field">My Custom Field:</label>';
            echo '<input type="text" id="my_custom_field" name="my_custom_field" value="' . esc_attr($field_value) . '" />';
        }











        public function load_assets()
        {
            wp_enqueue_style(
                'my-form',
                plugin_dir_url(__FILE__) . 'css/my-form.css',
                array(),
                1,
                'all'
            );

            wp_enqueue_script(
                'my-form',
                plugin_dir_url(__FILE__) . 'js/my-form.js',
                array('jquery'),
                1,
                true
            );
        }

        public function load_shortcode()
        {
?>

            <div class="my-form">
                <h1>Send us an email</h1>
                <p>Please fill the below form</p>

                <form id="my-form">
                    <input name="name" type="text" placeholder="Name">

                    <input name="email" type="email" placeholder="Email">

                    <input name="phone" type="tel" placeholder="Phone">

                    <textarea name="message" placeholder="Type your message"></textarea>

                    <button type="submit">Send message</button>
                </form>
            </div>

        <?php
        }


        public function load_scripts()
        {
        ?>
            <script>
                let nonce = '<?php echo wp_create_nonce('wp_rest'); ?>';

                (function($) {

                    $('#my-form').submit(function(event) {

                        event.preventDefault();

                        let form = $(this).serialize();

                        $.ajax({
                            method: 'post',
                            url: '<?php echo get_rest_url(null, 'my-form/v1/send-email'); ?>',
                            headers: {
                                'X-WP-Nonce': nonce
                            },
                            data: form

                        })

                    });

                })(jQuery)
            </script>

<?php
        }


        public function register_rest_api()
        {

            register_rest_route('my-form/v1', 'send-email', array(

                'methods' => 'POST',
                'callback' => array($this, 'handle_my_form')
            ));
        }


        public function handle_my_form($data)
        {

            $headers = $data->get_headers();
            $params = $data->get_params();
            $nonce = $headers['x_wp_nonce'][0];

            // echo json_encode($headers);

            echo json_encode($params);

            if (!wp_verify_nonce($nonce, 'wp_rest')) {

                return new WP_REST_Response('Message not sent', 422);
            }

            $post_id = wp_insert_post([
                'post_type' => 'my_form',
                'post_title' => 'Contact enquiry',
                'post_status' => 'publish',
            ]);

            if ($post_id) {
                
                return new WP_REST_Response('Thank you for your email', 200);
            }
        }
    }

    new MyForm;
}
