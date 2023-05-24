<?php

/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context          	= Timber::context();
$context['posts'] 	= new Timber\PostQuery();
$context['post_count'] = $wp_query->found_posts;
$context['categories'] = Timber::get_terms('category');


$context['posts_title'] = get_field('title', 'posts_page');
$context['posts_subtext'] = get_field('subtext', 'posts_page');
$context['posts_cta'] = get_field('call_to_action', 'posts_page');

$templates        	= array('index.twig');
if (is_home()) {
	array_unshift(
		$templates,
		'front-page.twig',
		'home.twig'
	);
}
Timber::render($templates, $context);
