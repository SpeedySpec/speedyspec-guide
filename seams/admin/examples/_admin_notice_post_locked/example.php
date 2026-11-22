<?php
// Prints the dialog the editor shows when another user is editing the post, with options to go back, preview or take over.
$other = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password(), 'role' => 'editor' ) );
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
update_post_meta( $post, '_edit_lock', time() . ':' . $other );
$GLOBALS['post'] = get_post( $post );
$html = guide_render( '_admin_notice_post_locked' );
return array( str_contains( $html, 'post-lock-dialog' ), str_contains( $html, 'grace' ) );
