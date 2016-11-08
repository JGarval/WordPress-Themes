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

# register_post_type should only be invoked through the 'init' action.
# It will not work if called before 'init', and aspects of the newly created or modified post type will work incorrectly if called later
add_action( 'init', 'register_cpt_course' );

function register_cpt_course() {

	$args = array(
		'labels'              => array(
			'name'                  => __( 'Cursos', 'lms-theme' ),
			'singular_name'         => __( 'Curso', 'lms-theme' ),
			'add_new'               => __( 'Añadir nuevo', 'lms-theme' ),
			'add_new_item'          => __( 'Añadir nuevo curso', 'lms-theme' ),
			'edit_item'             => __( 'Editar curso', 'lms-theme' ),
			'new_item'              => __( 'Nuevo curso', 'lms-theme' ),
			'view_item'             => __( 'Ver curso', 'lms-theme' ),
			'search_items'          => __( 'Buscar cursos', 'lms-theme' ),
			'not_found'             => __( 'No se ha encontrado ningún curso', 'lms-theme' ),
			'not_found_in_trash'    => __( 'No se ha encontrado ningún curso en la papelera', 'lms-theme' ),
			'all_items'             => __( 'Todos los cursos', 'lms-theme' ),
			'archives'              => true,
			'insert_into_item'      => __( 'Insertar en cursos', 'lms-theme' ),
			'uploaded_to_this_item' => __( 'Actualizar a este curso', 'lms-theme' ),
			'featured_image'        => __( 'Imagen destacada', 'lms-theme' ),
			'set_featured_image'    => __( 'Establecer imagen destacada', 'lms-theme' ),
			'remove_featured_image' => __( 'Quitar imagen destacada', 'lms-theme' ),
			'use_featured_image'    => __( 'Utilizar como imagen destacada', 'lms-theme' ),
			'menu_name'             => __( 'Cursos', 'lms-theme' ),
			'filter_items_list'     => __( 'Lista de cursos filtrados', 'lms-theme' ),
			'item_list_navigation'  => __( 'Lista de navegación de cursos', 'lms-theme' ),
			'items_list'            => __( 'Lista de cursos'),
			'name_admin_bar'        => __( 'Cursos', 'lms-theme' ),
			'views'                 => __( 'Vistas', 'lms-theme' ),
			'pagination'            => __( 'Paginación', 'lms-theme' ),
			'list'                  => __( 'Lista', 'lms-theme' ),
      // Labels for hierarchical post types only.
			//'parent_item'           => __( 'Curso padre', 'lms-theme' ),
			//'parent_item_colon'     => __( 'Curso padre:', 'lms-theme' ),
    ),
		'description'           => __( 'Crea cursos educativos con diferentes opciones.', 'lms-theme' ),
		'public'                => true,
  	'exclude_from_search'   => false,
  	'publicly_queryable'    => true,
  	'show_ui'               => true,
  	'show_in_nav_menus'     => false,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'capability_type'       => 'curso',
		'capabilities'          => array(
  		'edit_post'              => 'edit_curso',
  		'read_post'              => 'read_curso',
  		'delete_post'            => 'delete_curso',
  		'create_posts'           => 'create_cursos',
  		'edit_posts'             => 'edit_cursos',
  		'edit_others_posts'      => 'manage_cursos',
  		'publish_posts'          => 'manage_cursos',
  		'read_private_posts'     => 'read',
  		'read'                   => 'read',
  		'delete_posts'           => 'manage_cursos',
  		'delete_private_posts'   => 'manage_cursos',
  		'delete_published_posts' => 'manage_cursos',
  		'delete_others_posts'    => 'manage_cursos',
  		'edit_private_posts'     => 'edit_cursos',
  		'edit_published_posts'   => 'edit_cursos'
		),
 		'map_meta_cap'          => true,
  	'hierarchical'          => false,
  	'supports'              => array(
      'title',
      //'editor',
      //'excerpt',
      //'author',
      //'thumbnail',
      //'comments',
      //'trackbacks',
      //'custom-fields',
      //'revisions',
      //'page-attributes',
      'post-formats',
		),
		//'register_meta_box_cb'  =>
		//'taxonomies'            =>
		'has_archive'           => true,
		'rewrite'               => array(
      'slug'       => 'curso',
      'with_front' => false,
      'pages'      => true,
      'feeds'      => true,
      'ep_mask'    => EP_PERMALINK,
		),
		//'permalink_epmask'      => EP_PERMALINK, // Replaced 3.4
		'query_var'             => true,
		'can_export'            => true,
		'delete_with_user'      => false,
		'show_in_rest'          => true,
		'rest_base'             => true,
		//'rest_controller_class' => '',
		'_builtin'              => false, // Not for general use
		'_edit_link'            => false, // Not for general use
	);

	// Register our Custom Post Type.
	register_post_type( 'curso', $args );
}
