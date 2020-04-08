<?php

/**
 * Adds custom post types (CPTs).
 *
 * @var name the name (capitalized) of the post type
 * @var slug the slug (no caps, hypenated) of the post type
 * @var hasPluralForm boolean, determines whether or not the CPT
 * should be pluralized or not
 *
 * @TODO could be a smaller function if the conditional only
 * applied in instances where plurality mattered
 */
function cpt_factory($name, $slug, $hasPluralForm = true)
{
	if ($hasPluralForm == true) { // e.g. "Infographics"
		$labels = array(
			'name' => _x("{$name}s", 'post type general name'/*, 'your-plugin-textdomain'*/),
			'singular_name' => _x($name, 'post type singular name'/*, 'your-plugin-textdomain'*/),
			'menu_name' => _x("{$name}s", 'admin menu'/*, 'your-plugin-textdomain'*/),
			'name_admin_bar' => _x($name, 'add new on admin bar'/*, 'your-plugin-textdomain'*/),
			'add_new' => _x('Add New', $slug/*, 'your-plugin-textdomain'*/),
			'add_new_item' => __("Add New {$name}"/*, 'your-plugin-textdomain'*/),
			'new_item' => __("New {$name}"/*, 'your-plugin-textdomain'*/),
			'edit_item' => __("Edit {$name}"/*, 'your-plugin-textdomain'*/),
			'view_item' => __("View {$name}"/*, 'your-plugin-textdomain'*/),
			'all_items' => __("All {$name}s"/*, 'your-plugin-textdomain'*/),
			'search_items' => __("Search {$name}s"/*, 'your-plugin-textdomain'*/),
			'parent_item_colon' => __("Parent {$name}s:"/*, 'your-plugin-textdomain'*/),
			'not_found' => __("No {$name}s found."/*, 'your-plugin-textdomain'*/),
			'not_found_in_trash' => __("No {$name}s found in Trash"/*, 'your-plugin-textdomain'*/),
		);

		$args = array(
			'labels' => $labels,
			'description' => __('Description.'/*, 'your-plugin-textdomain'*/),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $slug),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'show_in_rest' => true,
			'rest_base' => "${slug}s",
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'map_meta_cap' => true,
		);
	} else { // e.g. "Leadership"
		$labels = array(
			'name' => _x($name, 'post type general name'/*, 'your-plugin-textdomain'*/),
			'singular_name' => _x($name, 'post type singular name'/*, 'your-plugin-textdomain'*/),
			'menu_name' => _x($name, 'admin menu'/*, 'your-plugin-textdomain'*/),
			'name_admin_bar' => _x($name, 'add new on admin bar'/*, 'your-plugin-textdomain'*/),
			'add_new' => _x('Add New', $slug/*, 'your-plugin-textdomain'*/),
			'add_new_item' => __("Add New {$name}"/*, 'your-plugin-textdomain'*/),
			'new_item' => __("New {$name}"/*, 'your-plugin-textdomain'*/),
			'edit_item' => __("Edit {$name}"/*, 'your-plugin-textdomain'*/),
			'view_item' => __("View {$name}"/*, 'your-plugin-textdomain'*/),
			'all_items' => __("All {$name}"/*, 'your-plugin-textdomain'*/),
			'search_items' => __("Search {$name}"/*, 'your-plugin-textdomain'*/),
			'parent_item_colon' => __("Parent {$name}:"/*, 'your-plugin-textdomain'*/),
			'not_found' => __("No {$name} found."/*, 'your-plugin-textdomain'*/),
			'not_found_in_trash' => __("No {$name} found in Trash"/*, 'your-plugin-textdomain'*/),
		);

		$args = array(
			'labels' => $labels,
			'description' => __('Description.'/*, 'your-plugin-textdomain'*/),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $slug),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'show_in_rest' => true,
			'rest_base' => $slug,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'map_meta_cap' => true,
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

	// COVID-19 Resources
	cpt_factory('COVID-19 Resource', 'covid-19');

	// Advocacy
	cpt_factory('Legislative Advocacy', 'legislative-advocacy', false);
	cpt_factory('Regulatory Advocacy', 'regulatory-advocacy', false);

	// Backpages
	cpt_factory('Custom Page', 'backpage');
}
add_action('init', 'cpt_generator');