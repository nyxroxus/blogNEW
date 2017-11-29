<?php get_header(); ?>
<?php get_template_part( 'partials/ContactPage/contact', 'form' ) ?>
<!-- Inline css for form success and error dialogs -->
<style type="text/css">
  .error{
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
  }
  .success{
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
  }
  form span{ color: red; }
</style>
<div class="pt4">
  <?php get_template_part('partials/ContactPage/page', 'contact-info'); ?>
  <?php get_template_part('partials/ContactPage/page', 'contact-form'); ?>
</div>


<?php get_footer(); ?>
