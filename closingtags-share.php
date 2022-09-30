<?php
/**
 * Plugin Name:       X-Post
 * Plugin URI:        https://www.closingtags.com/
 * Description:       Send published posts to various social media platforms
 * Version:           0.2
 * Author:            Dylan Hildenbrand
 * Author URI:        https://www.closingtags.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       x-post-closingtags
 * Domain Path:       /languages
 *
 */

// create menu page in admin interface
add_action('admin_menu', function() {
  add_menu_page( 'X-Post', 'X-Post', 'manage_options', 'x-post-closingtags', function() {require 'settings.php';}, 'dashicons-share' , 50);
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

