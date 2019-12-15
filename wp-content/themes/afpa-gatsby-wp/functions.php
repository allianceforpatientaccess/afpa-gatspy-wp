<?php
/*
 *  Author: Avi Nerenberg | @avinerenberg
 *  URL: https://github.com/avinoamsn/afpa-gatsby-wp
 *  Custom functions, support, custom post types and more.
 */

/**
 * Adds custom post types (CPTs).
 *
 * @var name the name (capitalized) of the post type
 * @var slug the slug (no caps, hypenated) of the post type
 * @var hasPluralForm boolean, determines whether or not the CPT
 *  should be pluralized or not
 *
 * @TODO could be a smaller function if the conditional only
 *  applied in instances where plurality mattered
 */
function cpt_factory($name, $slug, $hasPluralForm = true)
{
	if ($hasPluralForm == true) { // e.g. "Infographics"
		$labels = array(
			'name'               => _x("{$name}s", 'post type general name'/*, 'your-plugin-textdomain'*/),
			'singular_name'      => _x($name, 'post type singular name'/*, 'your-plugin-textdomain'*/),
			'menu_name'          => _x("{$name}s", 'admin menu'/*, 'your-plugin-textdomain'*/),
			'name_admin_bar'     => _x($name, 'add new on admin bar'/*, 'your-plugin-textdomain'*/),
			'add_new'            => _x('Add New', $slug/*, 'your-plugin-textdomain'*/),
			'add_new_item'       => __("Add New {$name}"/*, 'your-plugin-textdomain'*/),
			'new_item'           => __("New {$name}"/*, 'your-plugin-textdomain'*/),
			'edit_item'          => __("Edit {$name}"/*, 'your-plugin-textdomain'*/),
			'view_item'          => __("View {$name}"/*, 'your-plugin-textdomain'*/),
			'all_items'          => __("All {$name}s"/*, 'your-plugin-textdomain'*/),
			'search_items'       => __("Search {$name}s"/*, 'your-plugin-textdomain'*/),
			'parent_item_colon'  => __("Parent {$name}s:"/*, 'your-plugin-textdomain'*/),
			'not_found'          => __("No {$name}s found."/*, 'your-plugin-textdomain'*/),
			'not_found_in_trash' => __("No {$name}s found in Trash"/*, 'your-plugin-textdomain'*/),
		);

		$args = array(
			'labels'                => $labels,
			'description'           => __('Description.'/*, 'your-plugin-textdomain'*/),
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => $slug),
			'capability_type'       => 'post',
			'has_archive'           => true,
			'hierarchical'          => false,
			'menu_position'         => null,
			'show_in_rest'          => true,
			'rest_base'             => "${slug}s",
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'map_meta_cap'          => true,
		);
	} else { // e.g. "Leadership"
		$labels = array(
			'name'               => _x($name, 'post type general name'/*, 'your-plugin-textdomain'*/),
			'singular_name'      => _x($name, 'post type singular name'/*, 'your-plugin-textdomain'*/),
			'menu_name'          => _x($name, 'admin menu'/*, 'your-plugin-textdomain'*/),
			'name_admin_bar'     => _x($name, 'add new on admin bar'/*, 'your-plugin-textdomain'*/),
			'add_new'            => _x('Add New', $slug/*, 'your-plugin-textdomain'*/),
			'add_new_item'       => __("Add New {$name}"/*, 'your-plugin-textdomain'*/),
			'new_item'           => __("New {$name}"/*, 'your-plugin-textdomain'*/),
			'edit_item'          => __("Edit {$name}"/*, 'your-plugin-textdomain'*/),
			'view_item'          => __("View {$name}"/*, 'your-plugin-textdomain'*/),
			'all_items'          => __("All {$name}"/*, 'your-plugin-textdomain'*/),
			'search_items'       => __("Search {$name}"/*, 'your-plugin-textdomain'*/),
			'parent_item_colon'  => __("Parent {$name}:"/*, 'your-plugin-textdomain'*/),
			'not_found'          => __("No {$name} found."/*, 'your-plugin-textdomain'*/),
			'not_found_in_trash' => __("No {$name} found in Trash"/*, 'your-plugin-textdomain'*/),
		);

		$args = array(
			'labels'                => $labels,
			'description'           => __('Description.'/*, 'your-plugin-textdomain'*/),
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => $slug),
			'capability_type'       => 'post',
			'has_archive'           => true,
			'hierarchical'          => false,
			'menu_position'         => null,
			'show_in_rest'          => true,
			'rest_base'             => $slug,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'map_meta_cap'          => true,
		);
	}

	register_post_type($slug, $args);
}

function cpt_generator()
{
	// Home
	cpt_factory('Slider', 'slider');
	cpt_factory('Working Group', 'working-group');
	cpt_factory('Coalition', 'coalition');
	cpt_factory('Home Resource', 'home-resource');

	// About
	cpt_factory('Annual Report', 'annual-report');
	cpt_factory('Guiding Principle', 'guiding-principle');
	cpt_factory('Leadership', 'leadership', false);

	// Resources
	cpt_factory('Video', 'video');
	cpt_factory('Infographic', 'infographic');

	// Events
	cpt_factory('Event', 'event');

	// Surveys
	cpt_factory('Survey', 'survey');

	// Advocacy
	cpt_factory('Legislative Advocacy', 'legislative-advocacy', false);
	cpt_factory('Regulatory Advocacy', 'regulatory-advocacy', false);

	// Backpages
	cpt_factory('Custom Page', 'backpage');
}
add_action('init', 'cpt_generator');

/**
 * Removes the default editor for specific post types & page template
 */
function remove_editor()
{
	remove_post_type_support('slider', 'editor');
	remove_post_type_support('working-group', 'editor');
	remove_post_type_support('coalition', 'editor');
	remove_post_type_support('event', 'editor');
	remove_post_type_support('survey', 'editor');
	remove_post_type_support('home-resource', 'editor');
	remove_post_type_support('annual-report', 'editor');
	remove_post_type_support('infographic', 'editor');
	remove_post_type_support('legislative-advocacy', 'editor');
	remove_post_type_support('regulatory-advocacy', 'editor');

	// remove for specific page templates (e.g. everything but "About")
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	if (!isset($post_id)) return;

	$template_file = get_post_meta($post_id, '_wp_page_template', true);

	if ($template_file == 'page-template-no-editor.php') { // edit the template name
		remove_post_type_support('page', 'editor');
	}
}
add_action('init', 'remove_editor');

// Create new rewrite rule
// TODO: not working
// function login_rewrite()
// {
// 	add_rewrite_rule('^/?$', 'wp-login.php', 'top');
// }
// add_action('init', 'login_rewrite');

/**
 * Customize the admin sidebar.
 *
 * 1.) Remove unnecessary menu items from the menu object.
 * 2.) Order the menu appropriately
 */
function remove_menus()
{
	// remove_menu_page('index.php');                  // Dashboard
	// remove_menu_page('jetpack');                    // Jetpack*
	remove_menu_page('edit.php');                   // Posts
	// remove_menu_page('upload.php');                 // Media
	// remove_menu_page('edit.php?post_type=page');    // Pages
	remove_menu_page('edit-comments.php');          // Comments
	remove_menu_page('themes.php');                 // Appearance
	remove_menu_page('users.php');                  // Users
	remove_menu_page('tools.php');                  // Tools


	// remove if not on local site (if deployed environment)
	if (get_site_url() !== 'http://localhost/afpa') {
		remove_menu_page('plugins.php');                          // Plugins
		remove_menu_page('options-general.php');                  // Settings
		remove_menu_page('edit.php?post_type=acf-field-group');   // Advanced Custom Fields
		remove_menu_page('ai1wm_export');													// All-in-One WP Migration (@TODO not working)
		remove_menu_page('wpengine-common');											// WP Engine (@TODO not working)

	}
}
add_action('admin_menu', 'remove_menus');

add_action('admin_init', 'the_dramatist_debug_admin_menu');
function the_dramatist_debug_admin_menu()
{
	echo '<pre>' . print_r($GLOBALS['menu'], TRUE) . '</pre>';
}

// menu order
function wpse_custom_menu_order($menu_ord)
{
	if (!$menu_ord) return true;

	return array(
		// 'edit.php',                              // Posts
		'index.php',                                // Dashboard
		'separator1',                               // First separator

		// Home (index)
		'edit.php?post_type=slider',                // Sliders
		'edit.php?post_type=working-group',         // Working Groups
		'edit.php?post_type=home-resource',         // Resources
		// About
		'edit.php?post_type=annual-report',         // Annual Reports
		'edit.php?post_type=guiding-principle',     // Guiding Principles
		'edit.php?post_type=leadership',            // Leadership
		// Events
		'edit.php?post_type=event',                 // Events
		// Surveys
		'edit.php?post_type=survey',  							// Surveys
		// Resources
		'edit.php?post_type=video',                 // Video
		'edit.php?post_type=infographic',           // Infographic
		// Advocacy
		'edit.php?post_type=legislative-advocacy',  // Legislative Advocacy
		'edit.php?post_type=regulatory-advocacy',  	// Regulatory Advocacy
		// Coalitions
		'edit.php?post_type=coalition',             // Coalitions
		'separator2',                               // Second separator

		'edit.php?post_type=backpage',  						// Custom backpages
		'edit.php?post_type=page',                  // Pages
		'upload.php',                               // Media
		'admin.php?page=gf_edit_forms',							// Gravity Forms
		'separator-last',                           // Last separator

		// 'link-manager.php',                         // Links
		// 'edit-comments.php',                        // Comments
		// 'themes.php',                               // Appearance
		// 'plugins.php',                              // Plugins
		// 'users.php',                                // Users
		// 'tools.php',                                // Tools
		'options-general.php',                      // Settings
	);
}
add_filter('custom_menu_order', 'wpse_custom_menu_order', 10, 1);
add_filter('menu_order', 'wpse_custom_menu_order', 10, 1);


/**
 * Customize admin toolbar.
 *
 * 1.) Remove & add desired nodes.
 * 2.) Reorder the new-content node.
 */
function customize_toolbar()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');                 // remove comments
	$wp_admin_bar->remove_menu('new-post', 'new-content');  // remove new post
	$wp_admin_bar->add_node(array(                          // developer contact email
		'id'    =>  'contact-developer',
		'title'    =>  'Contact Developer',
		'href'    =>  'mailto:avi@allianceforpatientaccess.org',

	));
}
add_action('wp_before_admin_bar_render', 'customize_toolbar');

function order_new_content_node()
{
	global $wp_admin_bar;

	// remove all the nodes
	$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node('new-page');
	$wp_admin_bar->remove_node('new-user');
	// $wp_admin_bar->remove_node('slider');
	// $wp_admin_bar->remove_node('working-group');
	// $wp_admin_bar->remove_node('coalition');
	// $wp_admin_bar->remove_node('event');

	// add them back in order
	// $args = array(
	//   'id'     => 'new-post',
	//   'title'  => 'Blog Post',
	//   'parent' => 'new-content',
	//   'href'  => admin_url('post-new.php'),
	//   'meta'  => array('class' => 'ab-item')
	// );
	// $wp_admin_bar->add_node($args);
}
add_action('wp_before_admin_bar_render', 'order_new_content_node');

/**
 * Disable support for comments and trackbacks on all post types
 */
function df_disable_comments_post_types_support()
{
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status()
{
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments)
{
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect()
{
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard()
{
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar()
{
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

/**
 * Theme Support
 */
add_theme_support('post-thumbnails');

/**
 * Apply taxonomies to appropriate post types
 */
function register_taxonomies()
{
	// register_taxonomy_for_object_type('post_tag', 'attachment');
	register_taxonomy_for_object_type('post_tag', 'event');
	register_taxonomy_for_object_type('post_tag', 'survey');
	register_taxonomy_for_object_type('post_tag', 'leadership');
	register_taxonomy_for_object_type('post_tag', 'video');
	register_taxonomy_for_object_type('post_tag', 'legislative-advocacy');
	register_taxonomy_for_object_type('category', 'legislative-advocacy');
}
add_action('init', 'register_taxonomies');

/**
 * Require thumbnail image (featured media) on specific
 * post types.
 * - events
 * - coalitions
 */
function featured_image_requirement($post_id)
{
	$post = get_post($post_id);

	if ($post->post_status == 'publish' && !has_post_thumbnail($post_id) && (get_post_type() == 'event' || get_post_type() == 'coalition')) {
		$post->post_status = 'draft';
		wp_update_post($post);

		$message = '<p>Please, add a thumbnail!</p>'
			. '<p><a href="' . admin_url('post.php?post=' . $post_id . '&action=edit') . '">Go back and edit the post</a></p>';
		wp_die($message, 'Error - Missing thumbnail!');
	}
}
add_action('save_post', 'featured_image_requirement', -1);