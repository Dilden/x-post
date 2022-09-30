<?php
  //settings_fields( 'x_post_options');
  //$options = get_option('x_post_telegram');

if(isset($_POST['x_post_telegram_msg_txt'])) {
  if(x_post_sendto_telegram($_POST['x_post_telegram_msg_txt'])) {
    echo '<div class="notice notice-success">
    <p>Your message has been sent!</p>
    </div>';
  } else {
    echo '<div class="notice notice-warning">
    <p>Whoops! There was an error.</p>
    </div>';
  }

}

?>
<h2>Send a test post to your channel</h2>
<form method="post" id="x_post_telegram_msg">
  <p>
  <textarea name="x_post_telegram_msg_txt" cols="100" rows="10"></textarea>
  </p>
  <p class="submit">
    <input type="submit" class="button-primary" value="Send Post" />
  </p>
</form>

