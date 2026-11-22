<?php
// Creates a privacy request for an email and action, as a user_request post (pending, or confirmed with that status); an invalid email, unknown action or a duplicate pending request is a WP_Error.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
$post = get_post( $request );
return array( $post->post_type, $post->post_status, $post->post_title, $post->post_name, wp_create_user_request( 'admin@example.org', 'export_personal_data' )->get_error_code(), wp_create_user_request( 'bad', 'export_personal_data' )->get_error_code(), wp_create_user_request( 'a@example.org', 'nope' )->get_error_code() );
