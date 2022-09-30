<?php
  settings_fields( 'x_post_options');
  $options = get_option('x_post_telegram');
?>
<tr valign="top">
  <th scope="row">
    <h3>Telegram</h3>
  </th>
</tr>
<tr valign="top">
  <th scope="row">
    <label for="token">Bot Token
    </label>
  </th>
  <td>
    <input id="token" type="text" name="x_post_telegram[token]" value="<?php echo $options['token']; ?>" size="55" />
    <br>
    <small>Telegram Bot authentication key. <b>Keep it secret!</b>
    </small>
  </td>
</tr>
<tr valign="top">
  <th scope="row">
    <label for="username">Bot Username
    </label>
  </th>
  <td>
    <input id="username" type="text" name="x_post_telegram[username]" value="<?php echo isset( $options['username'] ) ? $options['username'] : ''; ?>" size="55" />
    <br>
    <small>Telegram Bot username. Example: <b>mywebsite_bot</b></small>
  </td>
</tr>
<tr valign="top">
  <th scope="row">
    <label for="channelusername">
      <?php _e('Channel Username', 'x-post-closingtags'); ?>
    </label>
  </th>
  <td>
    <input id="channelusername" type="text" name="x_post_telegram[channelusername]" value="<?php echo isset( $options['channelusername'] ) ? $options['channelusername'] : ''; ?>" size="55" />
    <br>
    <small>Insert channel username Example: <b>@mywebsite</b>
      <br>The bot must be admin in the channel
    </small>
  </td>
</tr>
<tr valign="top">
  <th scope="row">
    <label for="telegram_enabled">
      <?php _e('Enabled', 'x-post-closingtags'); ?>
    </label>
  </th>
  <td>
    <input id="telegram_enabled" type="checkbox" name="x_post_telegram[enabled]" <?php echo isset( $options['enabled'] ) ? 'checked' : ''; ?> />
  </td>
</tr>
