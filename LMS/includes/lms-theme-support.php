<?php
/*
* @package: lms-wordpress-theme
* @version: 1.0.0
* @author: javiergarval
*/

/*
* ==============================
* LMS-THEME-SUPPORT.PHP
* ==============================
*/

function lms_theme_support() {
  /********************
    Theme support
  ********************/
  add_theme_support('html5');
  add_theme_support('automatic_feed_links');
  /********************
    Translation file
  ********************/
  load_child_theme_textdomain('ldm-wordpress-theme', get_stylesheet_directory().'/languages');
}
add_action('after_setup_theme', 'lms_theme_support');
