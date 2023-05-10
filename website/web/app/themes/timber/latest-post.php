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

// Retrieve the latest blog post
$args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'orderby' => 'date',
  'order' => 'DESC',
);

$latest_post = new Timber\PostQuery($args);

// Pass the necessary information to the Twig template
if ($latest_post) {
  $context['post'] = $latest_post[0];
  $context['title'] = $latest_post[0]->title;
  $context['categories'] = $latest_post[0]->categories();
  $context['tags'] = $latest_post[0]->tags();
  $context['intro'] = $latest_post[0]->get_field('intro');
  $context['image'] = $latest_post[0]->get_field('image');
}

Timber::render($templates, $context);
