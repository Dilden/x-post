<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
  <h2>X-Post Settings</h2>
  <form method="post" action="options.php">
  <table class="form-table">
    <?php
      require('form/telegram.php');
    ?>
  </table>
  <div class="clear"></div>
  <hr>
  <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
  </p>
  </form>
</div>
