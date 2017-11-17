<div class="tc default-navigation-bg-color">
<nav class="w-100">
  <div class="">
    <div class="w-10 dib">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link default-color-search-inverted"><i class="tc fa fa-home fa-2x pointer f2" style=""></i></a>
    </div>
    <h1 class="tc w-70 dib f4-l f5 f4-m custom-header-navigation default-color-navigation-inverted"><?php wp_nav_menu( array( 'theme_location'  => 'primary', 'container_class' => 'primary_menu' ) ); ?></h1>
    <div class="w-10 dib">
      <i class="tc fa fa-search fa-lg pointer f2 default-color-search-inverted" id="hideshow"></i>
    </div>
  </div>
  <div class="dn" id="search-form">
    <?php get_search_form(); ?>
  </div>
</nav>
<script>
jQuery(document).ready(function(){
    jQuery('#hideshow').live('click', function(event) {
         jQuery('#search-form').toggle('show');
    });
});
</script>
</div>
