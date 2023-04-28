<?php 
    function project_post_type() {
        register_post_type(
            'test_project', 
            array(
                'public'              => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => false,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'can_export'          => true,
                'delete_with_user'    => false,
                'hierarchical'        => false,
                'show_in_rest'        => true,
                'query_var'           => 'test_projects',

                'supports'            => array(
                    'title', 
                    'thumbnail',
                    'editor'),

                'has_archive' => true, 
                'menu_icon' => 'dashicons-admin-multisite',

                'labels' => array(
                    'name'           => 'Projects',
                    'add_new_item'   => 'Add Project',
                    'edit_item'      => 'Edit Project',
                    'singular_name'  => 'Project',
                    'all_items'      => 'All Projects'
                )
            )
        );


        register_post_type(
            'test_portfolio', 
            array(
                'public'              => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => false,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'can_export'          => true,
                'delete_with_user'    => false,
                'hierarchical'        => false,
                'show_in_rest'        => true,
                'query_var'           => 'test_portfolio',

                'supports'            => array(
                    'title', 
                    'thumbnail',
                    'editor'),

                'has_archive' => true, 
                'menu_icon' => 'dashicons-portfolio',

                'labels' => array(
                    'name'           => 'Portfolio',
                    'add_new_item'   => 'Add Portfolio Item',
                    'edit_item'      => 'Edit Portfolio Item',
                    'singular_name'  => 'Portfolio',
                    'all_items'      => 'All Portfolio Items'
                ),

                // 'rewrite' => array(
                //     'with_front'  => false,
                //     'slug'        => __('portfolio', 'pmd-utility'),
                // ) 
            )
        );
    }

    add_action('init', 'project_post_type');