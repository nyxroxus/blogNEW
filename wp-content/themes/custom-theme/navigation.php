<nav class="w-100">
  <div class=""><!-- On other color schemes color this -->
    <h1 class="tl w-80 dib f4-l f5 f4-m custom-header-navigation default-color-navigation"><?php wp_nav_menu( array( 'theme_location'  => 'primary', 'container_class' => 'primary_menu' ) ); ?></h1>
    <div class="w-10 dib">
      <i class="tl fa fa-search pointer f4 default-color-search" id="hideshow"></i>
    </div>
  </div>

  <div class="dn default fixed" id="search-form" style="top:0; left:0; right: 0; bottom: 0;">
    <div class="" id="search-form" style="position: absolute; left: 50%; top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
      <?php get_search_form(); ?>
    </div>
    <div class="tr pr4 pt4 pointer" id="hideshow">
      <i class="fa fa-close fa-3x default-clean"></i>
    </div>
  </div>
</nav>
<script>
jQuery(document).ready(function(){
    jQuery('#hideshow').live('click', function(event) {
         jQuery('#search-form').toggle('show');
    });

    jQuery('.nav li > .sub-menu').parent().hover(function() {
      var submenu = $(this).children('.sub-menu');
      if ( jQuery(submenu).is(':hidden') ) {
        $(submenu).slideDown(200);
      } else {
        $(submenu).slideUp(200);
      }
    });
});


</script>
