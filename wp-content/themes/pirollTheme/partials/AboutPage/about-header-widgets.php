<?php
  /* Login behind widgets and when are they displayed */
if ( ! is_active_sidebar( 'projects-widget-image-area'  ) &&
     ! is_active_sidebar( 'projects-widget-text-area' ) &&
     ! is_active_sidebar( 'working-hours-widget-image-area' ) &&
     ! is_active_sidebar( 'working-hours-widget-text-area' ) &&
     ! is_active_sidebar( 'client-widget-image-area' ) &&
     ! is_active_sidebar( 'client-widget-text-area' ) &&
     ! is_active_sidebar( 'feedback-widget-image-area' ) &&
     ! is_active_sidebar( 'feedback-widget-text-area' )
     )
  return;
if ( is_active_sidebar( 'projects-widget-image-area'  ) &&
     is_active_sidebar( 'projects-widget-text-area' ) &&
     is_active_sidebar( 'working-hours-widget-image-area' ) &&
     is_active_sidebar( 'working-hours-widget-text-area' ) &&
     is_active_sidebar( 'client-widget-image-area' ) &&
     is_active_sidebar( 'client-widget-text-area' ) &&
     is_active_sidebar( 'feedback-widget-image-area' ) &&
     is_active_sidebar( 'feedback-widget-text-area' )
     ):
  /* Actual content with html elements */
  get_template_part( 'partials/AboutPage/page', 'about-content' );
 endif;
?>
