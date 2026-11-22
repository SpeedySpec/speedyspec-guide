<?php
// Registers the Google Fonts collection with its categories, its font families read from WordPress.org when asked for (here every request is blocked); on init.
_wp_register_default_font_collections();
$c = WP_Font_Library::get_instance()->get_font_collection( 'google-fonts' );
return array( $c->slug, is_wp_error( $c->get_data() ) );
