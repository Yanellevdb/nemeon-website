<?php
/**
 * Template Name: Template example page
 * The template for displaying custom template pages.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = new Timber\Post();

$context['post'] = $timber_post;
Timber::render( array( 'page-template.twig', 'page.twig' ), $context );
