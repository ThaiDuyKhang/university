<?php
function university_post_type()
{
    //Events post type
    register_post_type('event', array(
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'page-attributes',
        ),
        'rewrite' => array(
            'slug' => 'events'
        ),
        'has_archive' =>  true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add new event',
            'edit_item' => 'Edit event',
            'all_items' => 'All events',
            'singular_name' => 'Event',
        ),
        'menu_icon' => 'dashicons-calendar-alt',
    ));

    //Programs post type
    register_post_type('program', array(
        'supports' => array(
            'title',
            // 'editor',
            'thumbnail',
            'excerpt',
            'page-attributes',
        ),
        'rewrite' => array(
            'slug' => 'programs'
        ),
        'has_archive' =>  true,
        'public' => true,
        // 'show_in_rest' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add new program',
            'edit_item' => 'Edit program',
            'all_items' => 'All programs',
            'singular_name' => 'Program',
        ),
        'menu_icon' => 'dashicons-list-view',
    ));

    //Professor post type
    register_post_type('professor', array(
        'show_in_rest' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'page-attributes',
        ),
        // 'rewrite' => array(
        //     'slug' => 'professors'
        // ),
        // 'has_archive' =>  true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add new professor',
            'edit_item' => 'Edit professor',
            'all_items' => 'All professors',
            'singular_name' => 'Professor',
        ),
        'menu_icon' => 'dashicons-edit',
    ));

    //Campus post type
    register_post_type('campus', array(
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'page-attributes',
        ),
        'rewrite' => array(
            'slug' => 'campuses'
        ),
        'has_archive' =>  true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add new campus',
            'edit_item' => 'Edit campus',
            'all_items' => 'All campuses',
            'singular_name' => 'Campus',
        ),
        'menu_icon' => 'dashicons-location-alt',
    ));
}

add_action('init', 'university_post_type');
