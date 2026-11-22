<?php
// The viewport meta tag of the login page.
guide_load_functions( 'wp-login.php', 'login_header', 'login_footer', 'wp_shake_js', 'wp_login_viewport_meta' );
return guide_render( 'wp_login_viewport_meta' );
