<?php
/*
* @package: lms-wordpress-theme
* @version: 1.0.0
* @author: javiergarval
*/

/*
* ==============================
* CPT-COURSE.PHP
* ==============================
*/

add_action('init', 'register_cpt_course');
function register_cpt_course() {
  $args = array(
    'description'
    'public'
    'publicly_queryable'
    'exclude_from_search'
    'show_in_nav_menus'
    'show_ui'
    'show_in_menu'
  );
}
