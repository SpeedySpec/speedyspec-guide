<?php
// Hooked to wp_head: prints styles hiding the custom logo's header-text classes when the theme has no custom header text and the header_text theme mod is off.
$GLOBALS['_wp_theme_features']['custom-logo'] = array( array( 'header-text' => array( 'site-title', 'site-description' ) ) );
set_theme_mod( 'header_text', false );
return str_contains( guide_render( '_custom_logo_header_styles' ), '.site-title, .site-description' );
