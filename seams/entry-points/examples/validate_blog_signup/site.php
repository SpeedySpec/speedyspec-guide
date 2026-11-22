<?php
// Validates the user and site, then stores the site signup with add_signup_meta's meta and confirms it (multisite's after_signup_site hook sends the activation email); errors show the right step again.
guide_load_functions( 'wp-signup.php', 'do_signup_header', 'wpmu_signup_stylesheet', 'show_blog_form', 'validate_blog_form', 'show_user_form', 'validate_user_form', 'signup_another_blog', 'validate_another_blog_signup', 'confirm_another_blog_signup', 'signup_user', 'validate_user_signup', 'confirm_user_signup', 'signup_blog', 'validate_blog_signup', 'confirm_blog_signup', 'signup_get_available_languages' );
function guide_add_signup_source( $meta ) {
	return $meta + array( 'source' => 'guide' );
}
add_filter( 'add_signup_meta', 'guide_add_signup_source' );
$_POST = array( 'user_name' => 'grace', 'user_email' => 'grace@example.org', 'blogname' => 'graceblog', 'blog_title' => 'Grace', 'blog_public' => '0' );
$done = validate_blog_signup();
$row = $GLOBALS['wpdb']->get_row( "SELECT domain, path, title, user_login, meta FROM {$GLOBALS['wpdb']->signups}", ARRAY_A );
$row['meta'] = unserialize( $row['meta'] );
return array( $done, $row );
