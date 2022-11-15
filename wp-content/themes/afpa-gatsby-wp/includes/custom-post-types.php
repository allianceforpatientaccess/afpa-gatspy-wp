<?php

/**
 * Adds custom post types (CPTs).
 *
 * @param mixed $name the name (capitalized) of the post type
 * @param mixed $slug the slug (no caps, hyphenated) of the post type
 * @param bool $hasPluralForm whether or not the CPT should be pluralized
 * @param bool $parent the top-level menu item the CPT will go under
 * @return void
 *
 * @TODO reduce function size by omitting default vals
 * @TODO DRY out function (only specific fields change) w/r/t plurality
 */
function cpt_factory($name, $slug, $hasPluralForm = true, $parent = true)
{
  if ($hasPluralForm) { // e.g. "Infographics"
    $labels = array(
      'name' => _x("{$name}s", 'post type general name'),
      'singular_name' => _x($name, 'post type singular name'),
      'menu_name' => _x("{$name}s", 'admin menu'),
      'name_admin_bar' => _x($name, 'add new on admin bar'),
      'add_new' => _x('Add New', $slug),
      'add_new_item' => __("Add New {$name}"),
      'new_item' => __("New {$name}"),
      'edit_item' => __("Edit {$name}"),
      'view_item' => __("View {$name}"),
      'all_items' => __("All {$name}s"),
      'search_items' => __("Search {$name}s"),
      'parent_item_colon' => __("Parent {$name}s:"),
      'not_found' => __("No {$name}s found."),
      'not_found_in_trash' => __("No {$name}s found in Trash"),
    );

    $args = array(
      'labels' => $labels,
      'description' => __('Description.'),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => $parent,
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
      'name' => _x($name, 'post type general name'),
      'singular_name' => _x($name, 'post type singular name'),
      'menu_name' => _x($name, 'admin menu'),
      'name_admin_bar' => _x($name, 'add new on admin bar'),
      'add_new' => _x('Add New', $slug),
      'add_new_item' => __("Add New {$name}"),
      'new_item' => __("New {$name}"),
      'edit_item' => __("Edit {$name}"),
      'view_item' => __("View {$name}"),
      'all_items' => __("All {$name}"),
      'search_items' => __("Search {$name}"),
      'parent_item_colon' => __("Parent {$name}:"),
      'not_found' => __("No {$name} found."),
      'not_found_in_trash' => __("No {$name} found in Trash"),
    );

    $args = array(
      'labels' => $labels,
      'description' => __('Description.'),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => $parent,
      'query_var' => true,
      'rewrite' => array('slug' => $slug),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
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
  cpt_factory('Slider', 'slider', true, 'home');
  cpt_factory('Working Group', 'working-group', true, 'home');
  cpt_factory('Home Resource', 'home-resource', true, 'home');

  // Resources
  cpt_factory('Video', 'video', true, 'resources');
  cpt_factory('Infographic', 'infographic', true, 'resources');

  // Advocacy
  cpt_factory('Legislative Advocacy', 'legislative-advocacy', false, 'advocacy');
  cpt_factory('Regulatory Advocacy', 'regulatory-advocacy', false, 'advocacy');

  // About
  cpt_factory('Annual Report', 'annual-report', true, 'about');
  cpt_factory('Guiding Principle', 'guiding-principle', true, 'about');
  cpt_factory('Leadership', 'leadership', false, 'about');

  // Individual CPTs
  cpt_factory('Event', 'event');  // Events
  cpt_factory('Survey', 'survey');  // Surveys
  cpt_factory('Co-pay Resource', 'copay');  // Co-pay Accumulator Resources
  cpt_factory('Coalition', 'coalition');  // Coalitions

  // Custom Backpages & One-offs
  cpt_factory('Custom Page', 'backpage');
  cpt_factory('Neutropenia Resource', 'neutropenia-resource', true); // Neutropenia (prev. COVID-19) Resources
  cpt_factory('Asthma Resource', 'asthma-resource', true); // Asthma (prev. ICER) Resources
  cpt_factory('ICER Resource', 'icer-resource', true, 'icer'); // ICER Resources
  // cpt_factory('ICER Speaker', 'icer-speaker', true, 'icer'); // ICER Speakers // NOTE no longer in use
}
add_action('init', 'cpt_generator');
