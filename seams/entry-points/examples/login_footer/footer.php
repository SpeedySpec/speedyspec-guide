<?php
// Closes the login page: the back-to-site link (login_site_html_link), the language switcher when languages are installed, and the login_footer action.
guide_load_functions( 'wp-login.php', 'login_header', 'login_footer', 'wp_shake_js', 'wp_login_viewport_meta' );
function guide_back_to_site_link( $link ) {
	return str_replace( 'Go to', 'Back to', $link );
}
add_filter( 'login_site_html_link', 'guide_back_to_site_link' );
function guide_print_login_footer() {
	echo '<!-- login_footer -->';
}
add_action( 'login_footer', 'guide_print_login_footer' );
return guide_render( fn() => login_footer() );
