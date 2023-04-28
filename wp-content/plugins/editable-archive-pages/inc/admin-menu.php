<?php
/**
 *  Controls any of the menu items the plugin uses
 */

 function eap_add_post_type_admin_menu_items() {

    // get the options for this plugin
    $eap_options = get_option('eap_options');

    // if we have some options
    if ( ! empty($eap_options) && is_array($eap_options)) {

        // loop through the post types element of the options
        foreach ($eap_options['post_types'] as $post_type => $post_id) {
            
            // add menu item for this post type
            add_submenu_page(
                'edit.php?post_type=' . $post_type,
                __( 'Archive Page' , 'editable-archive-pages'),
                __( 'Archive Page' , 'editable-archive-pages'),
                'edit_posts',
                'post.php?post=' . absint($post_id) .'&action=edit',
                null
            );
        }

    }

 }

 add_action('admin_menu', 'eap_add_post_type_admin_menu_items', 10);