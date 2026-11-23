<?php
// Ajax handler that logs a user out everywhere else, or everywhere for another user, by destroying their sessions.
$sent = json_decode( guide_ajax( 'wp_ajax_destroy_sessions', array( 'user_id' => get_current_user_id(), 'nonce' => wp_create_nonce( 'update-user_' . get_current_user_id() ) ) ), true );
return array( $sent['success'], $sent['data']['message'] );
