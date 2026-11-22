<?php
// Prints the username and email fields of the signup form; signup_extra_fields fires after them.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
add_action( 'signup_extra_fields', fn( $errors ) => print( '<!-- signup_extra_fields -->' ) );
return guide_render( fn() => show_user_form( 'ada', 'ada@example.org', new WP_Error( 'user_name', 'Taken.' ) ) );
