<?php
// Prints, once the admin view transition styles have printed, an expect link blocking the first render until #wpcontent is parsed, so view transitions capture the full admin menu.
$before = guide_render( 'wp_print_view_transitions_render_blocking_link' );
wp_enqueue_view_transitions_admin_css();
guide_render( fn() => wp_print_styles( 'wp-view-transitions-admin' ) );
return array( $before, guide_render( 'wp_print_view_transitions_render_blocking_link' ) );
