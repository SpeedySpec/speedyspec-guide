<?php
// Hooked to admin_enqueue_scripts: enqueues the admin's cross-document view transition styles; dequeue wp-view-transitions-admin to turn them off.
wp_enqueue_view_transitions_admin_css();
return wp_style_is( 'wp-view-transitions-admin', 'enqueued' );
