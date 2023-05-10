<?php

// use Carbon_Fields\Container;
// use Carbon_Fields\Field;

// add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
// function crb_attach_theme_options() {
//     Container::make( 'theme_options', __( 'Theme Options' ) )
//         ->add_fields( array(
//             Field::make( 'text', 'crb_text', 'Text Field' ),
//         ) );
// }

// add_action( 'after_setup_theme', 'crb_load' );
// function crb_load() {
//     require_once( '../vendor/autoload.php' );
//     \Carbon_Fields\Carbon_Fields::boot();
// }

add_theme_support( 'post-thumbnails' );


// Add widgets and menus options
function custom_widgets_init() {
    register_sidebar( array(
        'name'          => 'Widget Area',
        'id'            => 'widget_area',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'custom_widgets_init' );


add_action('wp_enqueue_scripts', 'my_theme_enqueue_files');

function my_theme_enqueue_files()
{
    wp_enqueue_style('style', get_stylesheet_uri());
}