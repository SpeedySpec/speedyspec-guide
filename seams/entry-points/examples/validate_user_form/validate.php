<?php
// Validates the posted username and email with wpmu_validate_user_signup().
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
$_POST = array( 'user_name' => 'Ab', 'user_email' => 'nope' );
$bad = validate_user_form();
$_POST = array( 'user_name' => 'grace', 'user_email' => 'grace@example.org' );
$good = validate_user_form();
return array( $bad['errors']->get_error_messages(), $good['errors']->has_errors(), $good['user_name'] );
