<?php
// Reading, renaming, recording use of and deleting application passwords by UUID; each change fires its action, and an unknown UUID gives application_password_not_found.
add_action( 'wp_update_application_password', fn( $user, $item ) => print( "renamed to {$item['name']}\n" ), 10, 2 );
add_action( 'wp_delete_application_password', fn( $user, $item ) => print( "deleted {$item['name']}\n" ), 10, 2 );
$_SERVER['REMOTE_ADDR'] = '10.0.0.5';
list( , $item ) = WP_Application_Passwords::create_new_application_password( 1, array( 'name' => 'Phone' ) );
WP_Application_Passwords::create_new_application_password( 1, array( 'name' => 'Laptop' ) );
WP_Application_Passwords::update_application_password( 1, $item['uuid'], array( 'name' => 'Tablet' ) );
WP_Application_Passwords::record_application_password_usage( 1, $item['uuid'] );
$used = WP_Application_Passwords::get_user_application_password( 1, $item['uuid'] );
$exists = WP_Application_Passwords::application_name_exists_for_user( 1, 'TABLET' );
WP_Application_Passwords::delete_application_password( 1, $item['uuid'] );
return array( $used['last_ip'], $exists, count( WP_Application_Passwords::get_user_application_passwords( 1 ) ), WP_Application_Passwords::delete_all_application_passwords( 1 ), WP_Application_Passwords::delete_application_password( 1, 'x' )->get_error_code() );
