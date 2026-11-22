<?php
// Tells a new user their site is almost ready, to activate it from the email, with tips when it doesn't arrive.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
return substr( guide_render( fn() => confirm_blog_signup( 'example.org', '/graceblog/', 'Grace', 'grace', 'grace@example.org' ) ), 0, 400 );
