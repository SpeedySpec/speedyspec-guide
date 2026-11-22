<?php
// For a logged-in user: the form to add another site, listing the sites they belong to; signup_another_blog_init can change the defaults.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
guide_log_in();
add_filter( 'signup_another_blog_init', fn( $d ) => array_merge( $d, array( 'blog_title' => 'Suggested' ) ) );
return substr( guide_render( fn() => signup_another_blog( 'second' ) ), 0, 900 );
