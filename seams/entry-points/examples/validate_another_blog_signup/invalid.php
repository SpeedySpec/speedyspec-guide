<?php
// Validates the posted site and creates it for the logged-in user; with errors it shows the form again and returns false.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
guide_log_in();
$_POST = array( 'blogname' => 'x', 'blog_title' => 'X', 'blog_public' => '1' );
$created = validate_another_blog_signup();
return array( $created, $GLOBALS['errors']->get_error_codes() );
