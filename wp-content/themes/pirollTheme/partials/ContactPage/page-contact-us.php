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
<div class="pt2 tc contact-content">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.286242746387!2d-118.41965128568094!3d34.062175824655796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bb8b3cfc7839%3A0x6f5778ce061fb0ff!2s10111+Santa+Monica+Blvd%2C+Los+Angeles%2C+CA+90024%2C+USA!5e0!3m2!1sen!2srs!4v1511974840503" width="1920" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>


<?php get_footer(); ?>
