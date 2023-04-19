<?php

function nucleon_loadmore_ajax_handler(){
  global $wp_query;

  // prepare our arguments for the query
  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
  $args['post_status'] = 'publish';

  $posts = Timber::get_posts( $args );

  Timber::render( 'partial/loadmore-posts-loop.twig', array( 'posts' => $posts ) );

  die();
}

add_action('wp_ajax_loadmore', 'nucleon_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'nucleon_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
