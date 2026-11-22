<?php
// Prints the site fields of the signup form: the site name (as a subdirectory here), the title, the language when languages are installed, and the privacy choice; errors show beside their fields. signup_blogform fires at the end.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
function guide_print_signup_blogform( $errors ) {
	echo '<!-- signup_blogform -->';
}
add_action( 'signup_blogform', 'guide_print_signup_blogform' );
$errors = new WP_Error( 'blogname', 'That name is taken.' );
return guide_render( fn() => show_blog_form( 'mysite', 'My Site', $errors ) );
