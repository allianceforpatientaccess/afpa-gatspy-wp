<?php

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
	register_taxonomy_for_object_type('category', 'coalition');
}
add_action('init', 'register_taxonomies');