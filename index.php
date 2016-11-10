<?php
/*
* @package: lms-wordpress-theme
* @version: 1.0.0
* @author: javiergarval
*/

/*
* ==============================
* INDEX.PHP
* ==============================
*/

get_header();
?>
    <body>
<?php
include_once(get_stylesheet_directory().'/connection.php');
get_sidebar();

get_footer();
