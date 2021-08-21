<?php

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

	// remove all the nodes from the 'Add Post' dropdown
	$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node('new-page');
	$wp_admin_bar->remove_node('new-user');

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
