<?php
// Replaces wp_admin_bar_header on wp_head with an inline print style on admin-bar; when it isn't hooked, it does nothing.
wp_register_style( 'admin-bar', false );
add_action( 'wp_head', 'wp_admin_bar_header' );
wp_enqueue_admin_bar_header_styles();
return array( has_action( 'wp_head', 'wp_admin_bar_header' ), wp_styles()->get_data( 'admin-bar', 'after' ) );
