<?php
// A theme's page templates for a post type, by file with their names: its PHP files' Template Name headers, and a block theme's customTemplates; filtered by theme_{$post_type}_templates.
return array( wp_get_theme( 'twentytwenty' )->get_page_templates( null, 'page' ), wp_get_theme( 'twentytwenty' )->get_page_templates( null, 'attachment' ) );
