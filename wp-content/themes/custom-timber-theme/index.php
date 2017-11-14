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
 $post = new TimberPost();
 if (isset($post->image_id) && strlen($post->image_id)){
     $post->image_id = new TimberImage($post->image_id);
 }
 $data = Timber::get_context();
 $data['post'] = $post;
 Timber::render('index.twig', $data);
