<?php
/**
* Events
**/

$labels = array(
  'name'                => _x('Events', 'Post Type General Name', 'timber'),
  'singular_name'       => _x('Event', 'Post Type Singular Name', 'timber'),
  'menu_name'           => __('Event', 'timber'),
  'parent_item_colon'   => __('Parent Event', 'timber'),
  'all_items'           => __('All Events', 'timber'),
  'view_item'           => __('View Event', 'timber'),
  'add_new_item'        => __('Add New Event', 'timber'),
  'add_new'             => __('Add New', 'timber'),
  'edit_item'           => __('Edit Event', 'timber'),
  'update_item'         => __('Update Event', 'timber'),
  'search_items'        => __('Search Event', 'timber'),
  'not_found'           => __('Not Found', 'timber'),
  'not_found_in_trash'  => __('Not found in Trash', 'timber'),
);


$args = array(
  'label'               => __('Events', 'timber'),
  'description'         => __('User Events', 'timber'),
  'labels'              => $labels,
  'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
  'taxonomies'          => array(),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_meeventnu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'show_in_rest'        => true,
  'menu_position'       => 20,
  'can_export'          => true,
  'has_archive'         => true,
  'rewrite'             => array('slug'=>'events'),
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'page',
  'menu_icon'           => 'dashicons-id'
);

register_post_type('events', $args);
