<?php
// A privacy request: its email, action, status, user, times, confirmation key and request data, from a user_request post.
$id = wp_create_user_request( 'admin@example.org', 'export_personal_data', array( 'note' => 'please' ) );
$req = new WP_User_Request( get_post( $id ) );
return array( $req->email, $req->user_id, $req->action_name, $req->status, $req->request_data, $req->confirmed_timestamp );
