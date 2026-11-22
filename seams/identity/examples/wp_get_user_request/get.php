<?php
// A privacy request as a WP_User_Request, or false.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
$req = wp_get_user_request( $request );
return array( get_class( $req ), $req->email, $req->action_name, $req->status, wp_get_user_request( 999 ) );
