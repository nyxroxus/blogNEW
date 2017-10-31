?>
<div class="wrap">
  <h1>Theme panel</h1>
  <form method="post" action="options.php">

      <?php
        settings_fields("section");
        do_settings_sections("theme-options");
        submit_button();
      ?>
  </form>
</div>
<?php
function display_facebook_url()
{
  ?>
  <input type="text" name="fb_url" id="facebook_url" value="<?php echo get_option("facebook_url")?>"/>
  <?php
}
function display_theme_panel_fields() {
  add_settings_section("section", "All settings", null, "theme-options");
  add_settings_field("facebook_url", "Facebook url" , "display_facebook_url" , "theme-options", "section");
  register_setting("section", "facebook_url");
}


 ?>
