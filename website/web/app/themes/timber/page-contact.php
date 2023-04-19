<?php
/**
 * Template Name: Contact page
 * The template for displaying contact pages.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = new Timber\Post();

$context['title'] = get_field('title');
$context['cta'] = get_field('call_to_action');
$context['form_text'] = get_field('form_text');
$context['form'] = '[contact-form-7 id="' . get_field('form') . '"]';

$context['post'] = $timber_post;
Timber::render( array( 'page-contact.twig', 'page.twig' ), $context );
