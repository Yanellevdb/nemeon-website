<?php

/**
 * The template for displaying the latest blog post.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

use Timber\Timber;

$templates = array('latest-post.twig');

$context = Timber::context();

$latest_post = new Timber\PostQuery([
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page' => 1,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);

$context['post'] = $latest_post[0];

$context['block']['title'] = 'Laatste blogpost';
$context['block']['image'] = $latest_post[0]->image();
$context['block']['link'] = [
  'label' => 'Lees meer',
  'url'   => $latest_post[0]->link(),
  'text'  => $latest_post[0]->title(),
];
