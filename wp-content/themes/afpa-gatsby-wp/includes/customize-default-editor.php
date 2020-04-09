<?php

/**
 * Removes the default editor for specific post types & page templates
 */
function remove_editor()
{
	remove_post_type_support('slider', 'editor');
	remove_post_type_support('working-group', 'editor');
	remove_post_type_support('coalition', 'editor');
	remove_post_type_support('event', 'editor');
	remove_post_type_support('survey', 'editor');
	remove_post_type_support('covid-19', 'editor');
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