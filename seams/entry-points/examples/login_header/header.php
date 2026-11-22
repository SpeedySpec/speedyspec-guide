<?php
// Prints the login page's head and opening markup: the title (login_title), the login_head and login_enqueue_scripts actions, the body classes (login_body_class), the logo link (login_headerurl, login_headertext), the message (login_message) and the errors and notices from a WP_Error (login_errors, login_messages).
guide_load_functions( 'wp-login.php', 'login_header', 'login_footer', 'wp_shake_js', 'wp_login_viewport_meta' );
add_filter( 'login_message', fn( $m ) => $m . '<p class="message">Welcome</p>' );
add_filter( 'login_headerurl', fn() => 'http://example.org/' );
$errors = new WP_Error( 'incorrect_password', 'Wrong password.' );
$errors->add( 'loggedout', 'You are now logged out.', 'message' );
return guide_render( fn() => login_header( 'Log In', '', $errors ) );
