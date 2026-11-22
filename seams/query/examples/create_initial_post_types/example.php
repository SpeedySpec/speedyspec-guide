<?php
// Hooked to init: registers WordPress's post types (post, page, attachment, revision, nav_menu_item, wp_block, wp_template and the rest) and post statuses.
return array( post_type_exists( 'wp_navigation' ), post_type_exists( 'wp_font_family' ), get_post_status_object( 'future' )->label );
