<?php
// Validates the posted site name and title with wpmu_validate_blog_signup(), for the current user if logged in.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
$_POST = array( 'blogname' => 'ab', 'blog_title' => '' );
$result = validate_blog_form();
return array( $result['errors']->get_error_codes(), $result['domain'], $result['path'] );
