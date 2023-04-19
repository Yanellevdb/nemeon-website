<?php
/**
* Jobs
**/

$labels = array(
  'name'                => _x( 'Jobs', 'Post Type General Name', 'timber' ),
  'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'timber' ),
  'menu_name'           => __( 'Jobs', 'timber' ),
  'parent_item_colon'   => __( 'Parent Job', 'timber' ),
  'all_items'           => __( 'All Jobs', 'timber' ),
  'view_item'           => __( 'View Job', 'timber' ),
  'add_new_item'        => __( 'Add New Job', 'timber' ),
  'add_new'             => __( 'Add New', 'timber' ),
  'edit_item'           => __( 'Edit Job', 'timber' ),
  'update_item'         => __( 'Update Job', 'timber' ),
  'search_items'        => __( 'Search Job', 'timber' ),
  'not_found'           => __( 'Not Found', 'timber' ),
  'not_found_in_trash'  => __( 'Not found in Trash', 'timber' ),
);


$args = array(
  'label'               => __( 'Jobs', 'timber' ),
  'description'         => __( 'User Jobs', 'timber' ),
  'labels'              => $labels,
  'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
  'taxonomies'          => array(),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'show_in_rest'        => true,
  'menu_position'       => 20,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'page',
  'menu_icon'           => 'dashicons-id'
);

register_post_type( 'jobs', $args );
?>
