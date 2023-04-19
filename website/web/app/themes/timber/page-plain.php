<?php
/**
 * Template Name: Plain Content Page
 * The template for displaying plain wp content pages.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = new Timber\Post();

$context['post'] = $timber_post;
Timber::render( array( 'page-plain.twig', 'page.twig' ), $context );
