<?php

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