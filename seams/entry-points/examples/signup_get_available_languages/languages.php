<?php
// The installed languages a new site may use, which signup_get_available_languages can narrow but not widen; none are installed here.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
add_filter( 'signup_get_available_languages', fn() => array( 'de_DE' ) );
return signup_get_available_languages();
