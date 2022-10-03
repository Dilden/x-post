<?php
/**
 * Plugin Name:       X-Post
 * Plugin URI:        https://www.closingtags.com/
 * Description:       Send published posts to various social media platforms
 * Version:           1.0
 * Author:            Dylan Hildenbrand
 * Author URI:        https://www.closingtags.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       x-post-closingtags
 * Domain Path:       /languages
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', function(){
    load_plugin_textdomain( 'x-post-closingtags' );
} );

// create menu page in admin interface
add_action('admin_menu', function() {
  add_menu_page( 'X-Post', 'X-Post', 'manage_options', 'x-post-closingtags', function() {require 'settings.php';}, 'dashicons-share' , 50);
	add_submenu_page('x-post-closingtags', __('Send', 'x-post-closingtags'), __('Send a Test', 'x-post-closingtags'), 'manage_options', 'x-post-send', function() {require 'send.php';});
});

// create options to store in DB
add_action('admin_init', function() {
    register_setting('x_post_options', 'x_post_telegram');
    register_setting('x_post_options', 'x_post_mastodon');
    register_setting('x_post_options', 'x_post_twitter');
    register_setting('x_post_options', 'x_post_devto');
    register_setting('x_post_options', 'x_post_hackernoon');
    register_setting('x_post_options', 'x_post_hackernews');
});

// on post publish, send the post title + URL to telegram
add_action('transition_post_status', 'x_post_send', 10, 3);
function x_post_send($new_status, $old_status, $post) {
  if('publish' === $new_status && 'publish' !== $old_status && $post->post_type === 'post') {
    x_post_sendto_telegram(x_post_format($post));
  }
}

function x_post_format($post) {
  $message = get_the_title($post);

  if(has_excerpt($post)) {
    $message .= ' 

' . get_the_excerpt($post);
  }
  $message .= '

<a href="'. get_permalink($post).'">'. get_permalink($post) .'</a>';

  return $message;
}


// send message to telegram
function x_post_sendto_telegram($msg) {
  if ( !$msg || get_option('x_post_telegram')['enabled'] === null) { return false; }

  $url = 'https://api.telegram.org/bot' . get_option('x_post_telegram')['token'] . '/sendMessage';
  $data = new stdClass;
  $data->chat_id = get_option('x_post_telegram')['channelusername']; 
  $data->text = $msg; 
  $data->parse_mode = 'HTML';

  $url_call = $url . '?' . http_build_query($data);
  @file_get_contents( $url_call );

  if ( strpos( $http_response_header['0'], '400 Bad Request' ) !== false ) {
    echo '<div class="notice notice-error">
    <p>Error: incorrect parameters due to: .$http_response_header["0"]</p>
    <p>' . implode(' ', $data ) . '</p>
    </div>';
    return false;
  } else if ( strpos( $http_response_header['0'], '403 Forbidden' ) !== false ) {
    echo '<div class="notice notice-error">
    <p>User removed because bot has been blocked: '.$http_response_header["0"]. '</p>
    </div>';
    return false;
  }
  return true;
}
