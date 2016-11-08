<?php
/*
* @package: lms-wordpress-theme
* @version: 1.0.0
* @author: javiergarval
*/

/*
* ==============================
* FUNCTIONS.PHP
* ==============================
*/

/********************
  Including plugin files
********************/
// LMS Theme Support
include(get_stylesheet_directory().'/includes/lms-theme-support.php');
// CPT Course
include(get_stylesheet_directory().'/includes/cpt-course.php');

/********************
  Remove default WordPress head
********************/
// Really Simple Discovery Link
remove_action('wp_head', 'rsd_link');
// WP Version
remove_action('wp_head', 'wp_generator');
// RSS Feed Links
remove_action('wp_head', 'feed_links', 2);
// Extra RSS Feed Links
remove_action('wp_head', 'feed_links_extra', 3);
// Index Page Link
remove_action('wp_head', 'index_rel_link');
// remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'wlwmanifest_link');
// Random Post Link
remove_action('wp_head', 'start_post_rel_link', 10, 0);
// Parent Post Link
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
// Next & Previous Posts Link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
//
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
//
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
