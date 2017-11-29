<div class="weird" style="overflow: auto;">
  <div class="w-50-l fr-l">
    <div class="dn db-l">
      <?php the_post_thumbnail('wordpress-post-large'); ?>
    </div>
    <div class="dn-l">
      <?php the_post_thumbnail('wordpress-thumbnail'); ?>
    </div>
  </div>
  <div class="w-50-l fl-l pa5-l pa3">
    <h1><?php the_title(); ?></h1>
    <div class="pt4 lh-copy" style=""><?php the_content(); ?></div><br>
    <div class="">
      <?php if( get_field('client_name') ): ?>
      <p><b>Client name: </b><?php the_field('client_name'); ?></p><br>
      <?php endif; ?>
      <?php if( get_field('project_date') ): ?>
      <p><b>Project date: </b><?php the_field('project_date'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
