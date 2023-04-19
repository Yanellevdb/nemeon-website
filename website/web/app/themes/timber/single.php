<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$post = Timber::get_post();
$timber_post = new PostFlexible();
$context['single_post'] = $post;
$context['post'] = $timber_post;
$context['title'] = get_field('title');
$context['cta'] = get_field('call_to_action');
$context['gated_content'] = get_field('gated_content');
$context['form'] = '[contact-form-7 id="' . get_field("download_form")->ID . '"]';
$context['pdf'] = get_field('pdf');
$context['extra_information'] = get_field('extra_information');

if (post_password_required($timber_post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(array(
		'single-' . $timber_post->ID . '.twig',
		'single-' . $timber_post->post_type . '.twig',
		'single-' . $timber_post->slug . '.twig',
		'single.twig'),
	$context);
}
