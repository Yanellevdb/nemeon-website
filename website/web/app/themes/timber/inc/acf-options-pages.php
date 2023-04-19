<?php
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
    'redirect'		=> true,
    // 'icon_url'    => 'dashicons-images-alt2',
    'position'    => 60,
    'post_id'         => 'settings_page',
  ));

  acf_add_options_sub_page(
    array(
      'page_title'      => 'Jobs Page',
      'menu_title'      => 'Jobs Page',
      'parent_slug'     => 'edit.php?post_type=jobs',
      'post_id'         => 'jobs_page',
    )
  );

  acf_add_options_sub_page(
    array(
      'page_title'      => 'Posts Page',
      'menu_title'      => 'Posts Page',
      'parent_slug'     => 'edit.php',
      'post_id'         => 'posts_page',
    )
  );
}
