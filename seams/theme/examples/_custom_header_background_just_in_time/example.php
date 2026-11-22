<?php
// Hooked to wp_loaded: sets up custom header and background support's admin screens and head callbacks, once the theme declared them.
add_theme_support( 'custom-background' );
_custom_header_background_just_in_time();
return has_action( 'wp_head', '_custom_background_cb' );
