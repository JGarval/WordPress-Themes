# CPT CHEAT SHEET
* Credits to [@justinadlock](https://gist.github.com/justintadlock/6552000)

| Hook | Description | Value
| --- | --- | ---
| **description** | A short description of what your post type is. As far as I know, this isn't used anywhere in core WordPress. However, themes may choose to display this on post type archives. | string
| **public** | Whether the post type should be used publicly via the admin or by front-end users. This argument is sort of a catchall for many of the following arguments.  I would focus more on adjusting them to your liking than this argument. | bool (default is FALSE) |
| **publicly_queryable** | Whether queries can be performed on the front end as part of parse_request(). | bool (defaults to 'public')
| **exclude_from_search** | Whether to exclude posts with this post type from front end search results. | bool (defaults to 'public')
| **show_in_nav_menus** | Whether individual post type items are available for selection in navigation menus. | bool (defaults to 'public')
| **show_ui** | Whether to generate a default UI for managing this post type in the admin. You'll have more control over what's shown in the admin with the other arguments.  To build your own UI, set this to FALSE. | bool (defaults to 'public')
| **show_in_menu** | Whether to show post type in the admin menu. 'show_ui' must be true for this to work. Can also set this to a string of a top-level menu (e.g., 'tools.php'), which will make the post type screen be a sub-menu. | bool (defaults to 'show_ui')
| **show_in_admin_bar** | Whether to make this post type available in the WordPress admin bar. The admin bar adds a link to add a new post type item. | bool (defaults to 'show_in_menu')
| **menu_position** | The position in the menu order the post type should appear. **'show_in_menu' must be true** | int (defaults to 25 - below comments)
| **menu_icon** | The URI to the icon to use for the admin menu item or a dashicon class. See: https://developer.wordpress.org/resource/dashicons/ | string (defaults to use the post icon)
| **can_export** | Whether the posts of this post type can be exported via the WordPress import/export plugin or a similar plugin. | bool (defaults to TRUE)
| **delete_with_user** | Whether to delete posts of this type when deleting a user who has written posts. | bool (defaults to TRUE if the post type supports 'author')
| **hierarchical** | Whether this post type should allow hierarchical (parent/child/grandchild/etc.) posts. | bool (defaults to FALSE)
| **has_archive** | Whether the post type has an index/archive/root page like the "page for posts" for regular posts. If set to TRUE, the post type name will be used for the archive slug.  You can also set this to a string to control the exact name of the archive slug. | bool|string (defaults to FALSE)
| **query_var** | Sets the query_var key for this post type. If set to TRUE, the post type name will be used. You can also set this to a custom string to control the exact key. | bool|string (defaults to TRUE - post type name)
| **capability_type** | A string used to build the edit, delete, and read capabilities for posts of this type. You can use a string or an array (for singular and plural forms).  The array is useful if the plural form can't be made by simply adding an 's' to the end of the word.  For <CPT>, array( 'box', 'boxes' ). | string|array (defaults to 'post')
| **map_meta_cap** | Whether WordPress should map the meta capabilities (edit_post, read_post, delete_post) for you. If set to FALSE, you'll need to roll your own handling of this by filtering the 'map_meta_cap' hook. | bool (defaults to FALSE)
| **capabilities** | Provides more precise control over the capabilities than the defaults.  By default, WordPress will use the 'capability_type' argument to build these capabilities.  More often than not, this results in many extra capabilities that you probably don't need.  The following is how I set up capabilities for many post types, which only uses three basic capabilities you need to assign to roles: 'manage_<CPT>s', 'edit_<CPT>s', 'create_<CPT>s'.  Each post type is unique though, so you'll want to adjust it to fit your needs. | array
| **rewrite** | How the URL structure should be handled with this post type.  You can set this to an array of specific arguments or true|false.  If set to FALSE, it will prevent rewrite rules from being created. | array
| **supports** | What WordPress features the post type supports.  Many arguments are strictly useful on the edit post screen in the admin.  However, this will help other themes and plugins decide what to do in certain situations.  You can pass an array of specific features or set it to FALSE to prevent any features from being added.  You can use add_post_type_support() to add features or remove_post_type_support() to remove features later.  The default features are 'title' and 'editor'. | array|null

      # Register custom post types on the 'init' hook.
      add_action( 'init', 'my_register_post_types' );

      function my_register_post_types() {

      	// Set up the arguments for the post type.
      	$args = array(
      		'description'         => __( 'This is a description for my post type.', '<CPT>-textdomain' ),
      		'public'              => true,
      		'publicly_queryable'  => true,
      		'exclude_from_search' => false,
      		'show_in_nav_menus'   => false,
      		'show_ui'             => true,
      		'show_in_menu'        => true,
      		'show_in_admin_bar'   => true,
      		'menu_position'       => null,
      		'menu_icon'           => null,
      		'can_export'          => true,
      		'delete_with_user'    => false,
      		'hierarchical'        => false,
      		'has_archive'         => '<CPT>',
      		'query_var'           => '<CPT>',
      		'capability_type'     => '<CPT>',
      		'map_meta_cap'        => true,
      		'capabilities' => array(
      			// meta caps (don't assign these to roles)
      			'edit_post'              => 'edit_<CPT>',
      			'read_post'              => 'read_<CPT>',
      			'delete_post'            => 'delete_<CPT>',
      			// primitive/meta caps
      			'create_posts'           => 'create_<CPT>s',
      			// primitive caps used outside of map_meta_cap()
      			'edit_posts'             => 'edit_<CPT>s',
      			'edit_others_posts'      => 'manage_<CPT>s',
      			'publish_posts'          => 'manage_<CPT>s',
      			'read_private_posts'     => 'read',
      			// primitive caps used inside of map_meta_cap()
      			'read'                   => 'read',
      			'delete_posts'           => 'manage_<CPT>s',
      			'delete_private_posts'   => 'manage_<CPT>s',
      			'delete_published_posts' => 'manage_<CPT>s',
      			'delete_others_posts'    => 'manage_<CPT>s',
      			'edit_private_posts'     => 'edit_<CPT>s',
      			'edit_published_posts'   => 'edit_<CPT>s'
      		),
      		'rewrite' => array(
      			// The slug to use for individual posts of this type.
      			'slug'       => '<CPT>', // string (defaults to the post type name)
      			// Whether to show the $wp_rewrite->front slug in the permalink.
      			'with_front' => false, // bool (defaults to TRUE)
      			// Whether to allow single post pagination via the <!--nextpage--> quicktag.
      			'pages'      => true, // bool (defaults to TRUE)
      			// Whether to create pretty permalinks for feeds.
      			'feeds'      => true, // bool (defaults to the 'has_archive' argument)
      			// Assign an endpoint mask to this permalink.
      			'ep_mask'    => EP_PERMALINK, // const (defaults to EP_PERMALINK)
      		),
      		'supports' => array(
      			'title', // Post titles ($post->post_title).
      			'editor', // Post content ($post->post_content).
      			'excerpt', // Post excerpt ($post->post_excerpt).
      			'author', // Post author ($post->post_author).
      			'thumbnail', // Featured images (the user's theme must support 'post-thumbnails').
      			'comments', // Displays comments meta box.  If set, comments (any type) are allowed for the post.
      			'trackbacks', // Displays meta box to send trackbacks from the edit post screen.
      			'custom-fields', // Displays the Custom Fields meta box. Post meta is supported regardless.
      			'revisions', // Displays the Revisions meta box. If set, stores post revisions in the database.
      			'page-attributes', // Displays the Attributes meta box with a parent selector and menu_order input box.
      			'post-formats', // Displays the Format meta box and allows post formats to be used with the posts.
      		),
      		'labels' => array(
      			'name'                  => __( 'Posts', '<CPT>-textdomain' ),
      			'singular_name'         => __( 'Post', '<CPT>-textdomain' ),
      			'menu_name'             => __( 'Posts', '<CPT>-textdomain' ),
      			'name_admin_bar'        => __( 'Posts', '<CPT>-textdomain' ),
      			'add_new'               => __( 'Add New', '<CPT>-textdomain' ),
      			'add_new_item'          => __( 'Add New Post', '<CPT>-textdomain' ),
      			'edit_item'             => __( 'Edit Post', '<CPT>-textdomain' ),
      			'new_item'              => __( 'New Post', '<CPT>-textdomain' ),
      			'view_item'             => __( 'View Post', '<CPT>-textdomain' ),
      			'search_items'          => __( 'Search Posts', '<CPT>-textdomain' ),
      			'not_found'             => __( 'No posts found', '<CPT>-textdomain' ),
      			'not_found_in_trash'    => __( 'No posts found in trash', '<CPT>-textdomain' ),
      			'all_items'             => __( 'All Posts', '<CPT>-textdomain' ),
      			'featured_image'        => __( 'Featured Image', '<CPT>-textdomain' ),
      			'set_featured_image'    => __( 'Set featured image', '<CPT>-textdomain' ),
      			'remove_featured_image' => __( 'Remove featured image', '<CPT>-textdomain' ),
      			'use_featured_image'    => __( 'Use as featred image', '<CPT>-textdomain' ),
      			'insert_into_item'      => __( 'Insert into post', '<CPT>-textdomain' ),
      			'uploaded_to_this_item' => __( 'Uploaded to this post', '<CPT>-textdomain' ),
      			'views'                 => __( 'Filter posts list', '<CPT>-textdomain' ),
      			'pagination'            => __( 'Posts list navigation', '<CPT>-textdomain' ),
      			'list'                  => __( 'Posts list', '<CPT>-textdomain' ),

      			// Labels for hierarchical post types only.
      			'parent_item'        => __( 'Parent Post', '<CPT>-textdomain' ),
      			'parent_item_colon'  => __( 'Parent Post:', '<CPT>-textdomain' ),
      		)
      	);

      	// Register the post type.
      	register_post_type(
      		'<CPT>', // Post type name. Max of 20 characters. Uppercase and spaces not allowed.
      		$args      // Arguments for post type.
      	);
      }
