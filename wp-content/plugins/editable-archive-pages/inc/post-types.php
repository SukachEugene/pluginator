<?php

/**
 * Register the custom post types for the plugin
 */


function eap_register_archive_post_type()
{

    register_post_type(
        'eap_archive_page',
        array(
            'public'              => false,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'can_export'          => false,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => false,
            'query_var'           => 'eap_archive_page',
            'labels'              => array(
                'name'               => _x('Archive Pages', 'post type general name', 'post-type-archive-pages'),
                'singular_name'      => _x('Archive Page', 'post type singularl name', 'post-type-archive-pages'),
                'add_new'            => _x('Add New', 'pCall to Action', 'post-type-archive-pages'),

            ),
            'show_in_rest'        => true,
            'supports'            => array(
                'title',
                'editor',
                'thumbnail'
            ),


        )
    );
}

add_action('init', 'eap_register_archive_post_type');


function eap_create_archive_posts($post_type, $args)
{

    // if this post type is our archive pages post type
    if ('eap_archive_page' === $post_type) {
        return;
    }

    // if this post type should not be using archives
    if (false === $args->has_archive) {
        return;
    }

    // if this post type is not viewable
    if (!is_post_type_viewable($post_type)) {
        return;
    }

    // get the eap post type relationships from the options
    $eap_options = get_option('eap_options');
    
    // check whether this post type already has an archive page post created
    if ( empty($eap_options['post_types'][$post_type]) ) {

        $archive_post_id = wp_insert_post(
            apply_filters(
                'eap_insert_archive_page_args',
                array(
                    'post_type'    => 'eap_archive_page',
                    'post_title'   => sanitize_text_field($args->labels->name),
                    'post_status'  => 'publish',
                )
            )
        );

        // if the post was created
        if (0 !== $archive_post_id) {

            // add metadata to associate this archive page with this post type
            update_post_meta($archive_post_id, 'eap_post_type', $post_type);

            // add our new post type relationship to the options array
            $eap_options['post_types'][$post_type] = $archive_post_id;

            // update the options with the new relationship
            update_option('eap_options', $eap_options);
        }
    }

}

add_action('registered_post_type', 'eap_create_archive_posts', 10, 2);
