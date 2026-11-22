<?php
// The first signup step: username and email, and a choice of a site or only a username when wpmu_active_signup allows both (active_signup global); signup_user_init can change the defaults.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
$GLOBALS['active_signup'] = 'all';
return guide_render( fn() => signup_user( 'grace', 'grace@example.org' ) );
