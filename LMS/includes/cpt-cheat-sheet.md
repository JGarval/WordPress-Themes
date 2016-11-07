# CPT CHEAT SHEET

**00. 0000:**
> @description:
> @value:

**1. description:**
> @description: A short description of what your post type is. As far as I know, this isn't used anywhere in core WordPress.  However, themes may choose to display this on post type archives.
> @value: string

**2. public:**
> @description: Whether the post type should be used publicly via the admin or by front-end users. This argument is sort of a catchall for many of the following arguments.  I would focus more on adjusting them to your liking than this argument.
> @value: bool (default is FALSE)

**3. publicly_queryable:**
> @description: Whether queries can be performed on the front end as part of parse_request().
> @value: bool (defaults to 'public')

**4. exclude_from_search:**
> @description: Whether to exclude posts with this post type from front end search results.
> @value: bool (defaults to 'public')

**5. show_in_nav_menus:**
> @description: Whether individual post type items are available for selection in navigation menus.
> @value: bool (defaults to 'public')

**6. show_ui:**
> @description: Whether to generate a default UI for managing this post type in the admin. You'll have more control over what's shown in the admin with the other arguments.  To build your own UI, set this to FALSE.
> @value: bool (defaults to 'public')

**7. show_in_menu:**
> @description: Whether to show post type in the admin menu. 'show_ui' must be true for this to work. Can also set this to a string of a top-level menu (e.g., 'tools.php'), which will make the post type screen be a sub-menu.
> @value: bool (defaults to 'show_ui')

**8. show_in_admin_bar:**
> @description: Whether to make this post type available in the WordPress admin bar. The admin bar adds a link to add a new post type item.
> @value: bool (defaults to 'show_in_menu')

**9. menu_position:**
> @description: The position in the menu order the post type should appear. 'show_in_menu' must be true
> @value: int (defaults to 25 - below comments)

**10. menu_icon:**
> @description: The URI to the icon to use for the admin menu item or a dashicon class. See: https://developer.wordpress.org/resource/dashicons/
> @value: string (defaults to use the post icon)

**11. can_export:**
> @description: Whether the posts of this post type can be exported via the WordPress import/export plugin or a similar plugin.
> @value: bool (defaults to TRUE)

**12. delete_with_user:**
> @description: Whether to delete posts of this type when deleting a user who has written posts.
> @value: bool (defaults to TRUE if the post type supports 'author')

**13. hierarchical:**
> @description: Whether this post type should allow hierarchical (parent/child/grandchild/etc.) posts.
> @value: bool (defaults to FALSE)

**14. has_archive:**
> @description: Whether the post type has an index/archive/root page like the "page for posts" for regular posts. If set to TRUE, the post type name will be used for the archive slug.  You can also set this to a string to control the exact name of the archive slug.
> @value: bool|string (defaults to FALSE)

**15. query_var:**
> @description: Sets the query_var key for this post type. If set to TRUE, the post type name will be used. You can also set this to a custom string to control the exact key.
> @value: bool|string (defaults to TRUE - post type name)

**16. capability_type:**
> @description: A string used to build the edit, delete, and read capabilities for posts of this type. You can use a string or an array (for singular and plural forms).  The array is useful if the plural form can't be made by simply adding an 's' to the end of the word.  For example, array( 'box', 'boxes' ).
> @value: string|array (defaults to 'post')

**17. map_meta_cap:**
> @description: Whether WordPress should map the meta capabilities (edit_post, read_post, delete_post) for you. If set to FALSE, you'll need to roll your own handling of this by filtering the 'map_meta_cap' hook.
> @value: bool (defaults to FALSE)

**18. capabilities:**
> @description: Provides more precise control over the capabilities than the defaults.  By default, WordPress will use the 'capability_type' argument to build these capabilities.  More often than not, this results in many extra capabilities that you probably don't need.  The following is how I set up capabilities for many post types, which only uses three basic capabilities you need to assign to roles: 'manage_examples', 'edit_examples', 'create_examples'.  Each post type is unique though, so you'll want to adjust it to fit your needs.
> @value: array

  meta caps (don't assign these to roles)
  **  1. edit_post:** => 'edit_<CPT>',
  **  2. read_post:** => 'read_<CPT>',
  **  3. delete_post:** => 'delete_<CPT>',


		//
		'capabilities' => array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_example',
			'read_post'              => 'read_example',
			'delete_post'            => 'delete_example',
			// primitive/meta caps
			'create_posts'           => 'create_examples',
			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_examples',
			'edit_others_posts'      => 'manage_examples',
			'publish_posts'          => 'manage_examples',
			'read_private_posts'     => 'read',
			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_examples',
			'delete_private_posts'   => 'manage_examples',
			'delete_published_posts' => 'manage_examples',
			'delete_others_posts'    => 'manage_examples',
			'edit_private_posts'     => 'edit_examples',
			'edit_published_posts'   => 'edit_examples'
		),
		// How the URL structure should be handled with this post type.  You can set this to an
		// array of specific arguments or true|false.  If set to FALSE, it will prevent rewrite
		// rules from being created.
		'rewrite' => array(
			// The slug to use for individual posts of this type.
			'slug'       => 'example', // string (defaults to the post type name)
			// Whether to show the $wp_rewrite->front slug in the permalink.
			'with_front' => false, // bool (defaults to TRUE)
			// Whether to allow single post pagination via the <!--nextpage--> quicktag.
			'pages'      => true, // bool (defaults to TRUE)
			// Whether to create pretty permalinks for feeds.
			'feeds'      => true, // bool (defaults to the 'has_archive' argument)
			// Assign an endpoint mask to this permalink.
			'ep_mask'    => EP_PERMALINK, // const (defaults to EP_PERMALINK)
		),
		// What WordPress features the post type supports.  Many arguments are strictly useful on
		// the edit post screen in the admin.  However, this will help other themes and plugins
		// decide what to do in certain situations.  You can pass an array of specific features or
		// set it to FALSE to prevent any features from being added.  You can use
		// add_post_type_support() to add features or remove_post_type_support() to remove features
		// later.  The default features are 'title' and 'editor'.
		'supports' => array(
			// Post titles ($post->post_title).
			'title',
			// Post content ($post->post_content).
			'editor',
			// Post excerpt ($post->post_excerpt).
			'excerpt',
			// Post author ($post->post_author).
			'author',
			// Featured images (the user's theme must support 'post-thumbnails').
			'thumbnail',
			// Displays comments meta box.  If set, comments (any type) are allowed for the post.
			'comments',
			// Displays meta box to send trackbacks from the edit post screen.
			'trackbacks',
			// Displays the Custom Fields meta box. Post meta is supported regardless.
			'custom-fields',
			// Displays the Revisions meta box. If set, stores post revisions in the database.
			'revisions',
			// Displays the Attributes meta box with a parent selector and menu_order input box.
			'page-attributes',
			// Displays the Format meta box and allows post formats to be used with the posts.
			'post-formats',
		),
