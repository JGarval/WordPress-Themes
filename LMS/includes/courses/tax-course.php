<?php
/*
* @package: lms-wordpress-theme
* @version: 1.0.0
* @author: javiergarval
*/

/*
* ==============================
* TAX-COURSE.PHP
* ==============================
*/

add_action( 'init', 'register_course_taxonomies', 0 );
function register_course_taxonomies() {
  $labels = array(
    'name'              => _x( 'Pedidos', 'taxonomy general name', 'lms-theme' ),
		'singular_name'     => _x( 'Pedido', 'taxonomy singular name', 'lms-theme' ),
		'search_items'      => __( 'Buscar pedidos', 'lms-theme' ),
		'all_items'         => __( 'Todos los pedidos', 'lms-theme' ),
		'parent_item'       => __( 'Pedido padre', 'lms-theme' ),
		'parent_item_colon' => __( 'Pedido padre:', 'lms-theme' ),
		'edit_item'         => __( 'Editar pedido', 'lms-theme' ),
		'update_item'       => __( 'Actualizar pedido', 'lms-theme' ),
		'add_new_item'      => __( 'Añadir nuevo pedido', 'lms-theme' ),
		'new_item_name'     => __( 'Nuevo nombre de pedido', 'lms-theme' ),
		'menu_name'         => __( 'Pedido', 'lms-theme' ),
  );
  $args = array(
    'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'pedidos' ),
  );

  register_taxonomy('pedidos', array('curso'), $args);
}
