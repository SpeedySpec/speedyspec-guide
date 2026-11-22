<?php
// Replaces _admin_bar_bump_cb on wp_head with inline CSS that moves the page down for the bar, unless the theme gives its own callback.
wp_register_style( 'admin-bar', false );
add_action( 'wp_head', '_admin_bar_bump_cb' );
wp_enqueue_admin_bar_bump_styles();
return array( has_action( 'wp_head', '_admin_bar_bump_cb' ), count( wp_styles()->get_data( 'admin-bar', 'after' ) ) );
