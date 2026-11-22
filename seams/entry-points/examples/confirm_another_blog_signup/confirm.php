<?php
// Confirms a new site to its existing user: its link and the login link; signup_finished fires.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
function guide_print_signup_finished() {
	echo '<!-- signup_finished -->';
}
add_action( 'signup_finished', 'guide_print_signup_finished' );
return guide_render( fn() => confirm_another_blog_signup( 'example.org', '/second/', 'Second', 'ada' ) );
