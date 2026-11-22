<?php
// Hooked to wp_unique_post_slug: makes template and template part slugs unique per theme only.
return wp_filter_wp_template_unique_post_slug( 'header-2', 0, 'publish', 'wp_template_part', 'header' );
