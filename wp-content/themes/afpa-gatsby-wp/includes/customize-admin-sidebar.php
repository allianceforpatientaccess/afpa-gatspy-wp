<?php

/**
 * Customize the admin sidebar.
 *
 * 1.) Remove unnecessary menu items from the menu object.
 * 2.) Order the menu appropriately
 */
function remove_menus()
{
	remove_menu_page('edit.php');                   // Posts
	remove_menu_page('edit-comments.php');          // Comments
	// remove_menu_page('themes.php');                 // Appearance
	remove_menu_page('users.php');                  // Users
	remove_menu_page('tools.php');                  // Tools

	// remove if not on local site (if deployed environment)
	if (get_site_url() !== 'http://localhost/afpa') {
		// remove_menu_page('plugins.php');                          // Plugins
		// remove_menu_page('options-general.php');                  // Settings
		remove_menu_page('edit.php?post_type=acf-field-group');   // Advanced Custom Fields
		remove_menu_page('ai1wm_export');													// All-in-One WP Migration (@TODO not working)
		remove_menu_page('wpengine-common');											// WP Engine (@TODO not working)
	}
}
add_action('admin_init', 'remove_menus');

// returns the sidebar widget info necessary for removing it in the above function
// add_action('admin_init', 'the_dramatist_debug_admin_menu');
// function the_dramatist_debug_admin_menu()
// {
// 	echo '<pre>' . print_r($GLOBALS['menu'], TRUE) . '</pre>';
// }

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
		// COVID-19
		'edit.php?post_type=covid-19',  						// COVID-19 Resources
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
add_filter('custom_menu_order', 'wpse_custom_menu_order', 10, 1);
add_filter('menu_order', 'wpse_custom_menu_order', 10, 1);