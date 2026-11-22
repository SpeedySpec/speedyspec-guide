<?php
// Validates the user step: errors show the form again; a site signup goes on to the site step; a username-only signup is stored in the signups table and confirmed (multisite's after_signup_user hook sends the activation email).
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
$_POST = array( 'user_name' => 'grace', 'user_email' => 'grace@example.org', 'signup_for' => 'user' );
$done = validate_user_signup();
return array( $done, $GLOBALS['wpdb']->get_row( "SELECT user_login, user_email, active FROM {$GLOBALS['wpdb']->signups}", ARRAY_A ) );
