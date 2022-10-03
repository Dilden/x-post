<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('x_post_telegram');
delete_option('x_post_mastodon');
delete_option('x_post_twitter');
delete_option('x_post_devto');
delete_option('x_post_hackernoon');
delete_option('x_post_hackernews');

// for site options in Multisite
delete_site_option('x_post_telegram');
delete_site_option('x_post_mastodon');
delete_site_option('x_post_twitter');
delete_site_option('x_post_devto');
delete_site_option('x_post_hackernoon');
delete_site_option('x_post_hackernews');
