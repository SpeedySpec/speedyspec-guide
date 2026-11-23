<?php
// Ajax handler that saves the admin color scheme the user picked on their profile, and sends the old and new schemes as JSON.
register_admin_color_schemes();
$sent = json_decode( guide_ajax( 'wp_ajax_save_user_color_scheme', array( 'color_scheme' => 'ectoplasm', 'nonce' => wp_create_nonce( 'save-color-scheme' ) ) ), true );
return array( $sent['success'], get_user_option( 'admin_color' ) );
