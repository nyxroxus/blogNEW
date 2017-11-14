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
 $context         = Timber::get_context();
 $post            = new TimberPost();
 $context['post'] = $post;

 // Using the TimberImage() function
 // to retrieve the image via its ID i.e 8
 $context['custom_img'] = new TimberImage( 'image_id' );
 $name['name_change'] = Timber::get_context(function('get_option', 'blogname'));
 Timber::render( 'page.twig', $context );