<footer class="bg-darkergray pa4" style="clear: both; overflow: auto;">
    <?php
      if (   ! is_active_sidebar( 'first-footer-widget-area'  )
        && ! is_active_sidebar( 'second-footer-widget-area' )
      )
        return;

        if (   is_active_sidebar( 'first-footer-widget-area'  )
         &&    is_active_sidebar( 'second-footer-widget-area' )
      ) :
    ?>
    <div class="w-60-l fl-l" style="padding-top: 28px;">
      <aside class="w-40-l dib-l pl4-l tl-l tc clean pt0-l" role="complementary">
        <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
      </aside>
      <aside class="w-40-l dib-l tc pl3-l pt2-l pt4 clean">
        <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
      </aside>
    </div>
    <?php endif; ?>
    <div class="w-30-l fr-l pt4 pt0-l">
      <?php get_template_part('partials/Navigation/navigation', 'footer'); ?>
    </div>
    <?php wp_footer(); ?>

</footer>
</body>
</html>
