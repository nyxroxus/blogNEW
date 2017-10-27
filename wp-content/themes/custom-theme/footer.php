<footer class="clear c-bt--dashed c-bb--dashed bw2 b--lightred w-100 ph5 pv2">
  <div class="w-80 center tc">
    <h1 class="f2-l f4-m f3 custom-footer-navigation">
      <?php wp_nav_menu( array( 'theme_location'  => 'secondary', 'container_class' => 'secondary_menu' ) ); ?>
    </h1>
  </div>
  <p class="darkpurple tc">Blog template built with
    <a class="link lightred" href="http://tachyons.io/">Tachyons</a> by
    <a class="link lightred" href="https://twitter.com/NoxiousAlt">@NoxiousAlt</a>.
  </p>
</footer>
<p class="w-10 bg-lightred center tc">
  <a class="fa fa-angle-up link white f2" href="#"></a>
</p>
  <?php wp_footer(); ?>
</body>
</html>
