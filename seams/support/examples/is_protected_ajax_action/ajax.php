<?php
// Whether the AJAX request's action must keep working after a fatal error (plugin and theme updates and deletions, and those wp_protected_ajax_actions adds).
add_filter( 'wp_doing_ajax', '__return_true' );
$_REQUEST['action'] = 'update-plugin';
$update = is_protected_ajax_action();
$_REQUEST['action'] = 'heartbeat';
return array( $update, is_protected_ajax_action() );
