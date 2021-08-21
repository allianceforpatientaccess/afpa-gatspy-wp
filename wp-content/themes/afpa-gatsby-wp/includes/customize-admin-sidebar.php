<?php

/**
 * Customize the admin sidebar.
 *
 * 1. Remove unnecessary menu items from the menu object.
 * 2. Organize the menu.
 * 3. Order the menu. (This can also be done during the CPT init phase w/ `register_post_type`, but it's too late now.)
 */

// menu pruning
function remove_menus()
{
	remove_menu_page('edit.php');                   // Posts
	remove_menu_page('edit-comments.php');          // Comments
	// remove_menu_page('themes.php');              // Appearance
	// remove_menu_page('users.php');               // Users
	remove_menu_page('tools.php');                  // Tools

	// remove if not on local site (if deployed environment)
	if (get_site_url() !== 'http://localhost/afpa') {
		// remove_menu_page('plugins.php');                          // Plugins
		remove_menu_page('options-general.php');                  // Settings
		remove_menu_page('edit.php?post_type=acf-field-group');   // Advanced Custom Fields
		remove_menu_page('ai1wm_export');													// All-in-One WP Migration (@TODO not working)
		remove_menu_page('wpengine-common');											// WP Engine (@TODO not working)
	}
}
add_action('admin_init', 'remove_menus');

// menu organization (top-level menu items, for the CPTs to nest under)
function organize_admin_menu()
{
	// home page
	add_menu_page(
		'Home Page',
		'Home Page',
		'read',
		'home',
		'', // empty callback, as there's no associated CPT w/ these "section headers"
		'dashicons-admin-home'
	);

	// resources page
	add_menu_page(
		'Resources Page',
		'Resources Page',
		'read',
		'resources',
		'',
		'dashicons-database-add'
	);

	// advocacy page
	add_menu_page(
		'Advocacy Page',
		'Advocacy Page',
		'read',
		'advocacy',
		'',
		'dashicons-edit'
	);

	// about page
	add_menu_page(
		'About Page',
		'About Page',
		'read',
		'about',
		'',
		'dashicons-info-outline'
	);

	// ICER event page
	add_menu_page(
		'ICER Event Page',
		'ICER Event Page',
		'read',
		'icer',
		'',
		'dashicons-calendar'
	);
}
add_action('admin_menu', 'organize_admin_menu');

// menu order
function apply_custom_menu_order($menu_ord)
{
	if (!$menu_ord) return true;

	return array(
		// 'edit.php',                              // Posts
		'index.php',                                // Dashboard
		'separator1',                               // First separator


		// Main pages w/ multiple CPTs (nested menus)
		'home',                											// Home (index): Sliders, Working Groups, Home Resources
		'about',         														// About: Annual Reports, Guiding Principles, Leadership
		'resources',                 								// Resources: Video, Infographic
		'advocacy',  																// Advocacy: Legislative Advocacy, Regulatory Advocacy
		'separator2',                               // Second separator


		// individual
		'edit.php?post_type=event',                 // Events
		'edit.php?post_type=survey',  							// Surveys
		'edit.php?post_type=copay',  								// Co-pay Accumulator Resources
		'edit.php?post_type=coalition',             // Coalitions

		// special event/one-offs
		'edit.php?post_type=covid-19',  						// COVID-19 Resources
		'icer',																			// ICER: ICER Resources, ICER Speakers

		// Generic Pages & Functionality
		'edit.php?post_type=backpage',  						// Custom backpages
		'edit.php?post_type=page',                  // Pages
		'upload.php',                               // Media
		'gf_edit_forms',														// Gravity Forms
		'separator-last',                           // Last separator

		// 'link-manager.php',                         // Links
		// 'edit-comments.php',                        // Comments
		'themes.php',                               // Appearance
		'plugins.php',                              // Plugins
		// 'users.php',                                // Users
		// 'tools.php',                                // Tools
		'options-general.php',                      // Settings
	);
}
add_filter('custom_menu_order', 'apply_custom_menu_order');
add_filter('menu_order', 'apply_custom_menu_order');
