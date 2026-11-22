<?php
// The site step of a signup, carrying the username and email; the site name defaults to the username. signup_blog_init can change the defaults.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
return substr( guide_render( fn() => signup_blog( 'grace', 'grace@example.org' ) ), 0, 700 );
