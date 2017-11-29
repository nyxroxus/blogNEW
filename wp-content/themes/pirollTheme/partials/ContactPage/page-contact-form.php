<div id="respond" class="w-50-l tc fr-l pa5-l pa3">
  <?php echo $response; ?>
  <label for="" class="db dn-l tc pt4">
    <h2>Write to us:</h2>
  </label>
  <form action="<?php the_permalink(); ?>" method="post" style="" class="pt3">
    <div class="w-100-l tc" style="overflow: auto;">
      <p class="w-50-l fl-l tl-l">
      <input placeholder="Your Name" type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>" class="tl ph3 w-90-l w-100" style="height:30px;">
      </p>
      <p class="w-50-l fr-l pt0-l pt3 tr-l">
        <input placeholder="Your Surname" type="text" name="message_surname" value="<?php echo esc_attr($_POST['message_surname']); ?>" class=" tl ph3 w-90-l w-100" style="height:30px;">
      </p>
    </div><br>
    <p class="">
      <input placeholder="Your Email" type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>" class="tl ph3 w-100" style="height:30px;">
    </p><br>
    <textarea placeholder="Message text" type="text" name="message_text" class="pv2 ph3 w-100" style="clear: both; max-height: 109px; min-height: 109px">
      <?php echo esc_textarea($_POST['message_text']); ?>
    </textarea><br>
    </p><br>
    <div class="tl-l tc">
      <p class="">
      <h3 class="w-40-l dib-l tl-l tc pb3">Human verification:</h3>
      <input placeholder="Answer" type="text" style="" name="message_human" class="w-40-l dib-l"> + 3 = 5
      </p>
    </div>
    <br>
    <input type="hidden" name="submitted" value="1">
    <p class="tr-l tc"><input type="submit" class="ph4 pv3 widget-button white f7 b" value="SEND MESSAGE" style="border: none!important;"></p>
  </form>
</div>
