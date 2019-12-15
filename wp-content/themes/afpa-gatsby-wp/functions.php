<?php

/**
 *  Author: Avi Nerenberg | @avinerenberg
 *  URL: https://github.com/avinoamsn/afpa-gatsby-wp
 *  Custom functions, support, custom post types and more.
 */
require_once __DIR__ . '/includes/custom-post-types.php';
require_once __DIR__ . '/includes/customize-default-editor.php';
require_once __DIR__ . '/includes/customize-admin-sidebar.php';
require_once __DIR__ . '/includes/customize-admin-toolbar.php';
require_once __DIR__ . '/includes/disable-comments.php';
require_once __DIR__ . '/includes/require-thumbnail-image.php';
require_once __DIR__ . '/includes/theme-support.php';
require_once __DIR__ . '/includes/taxonomy-support.php';
require_once __DIR__ . '/includes/rewrites.php'; // TODO not working (intended for domain coherence on prod site)