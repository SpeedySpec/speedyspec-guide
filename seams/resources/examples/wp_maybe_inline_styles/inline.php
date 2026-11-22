<?php
// Turns small stylesheets that have a path into inline styles, up to 40,000 bytes in all (styles_inline_size_limit), smallest first, fixing relative URLs.
$file = ABSPATH . WPINC . '/css/dashicons.css';
wp_register_style( 'guide-small', includes_url( 'css/buttons.css' ) );
wp_style_add_data( 'guide-small', 'path', ABSPATH . WPINC . '/css/buttons.css' );
wp_enqueue_style( 'guide-small' );
wp_maybe_inline_styles();
return array( wp_styles()->registered['guide-small']->src, strlen( implode( '', (array) wp_styles()->get_data( 'guide-small', 'after' ) ) ) > 100 );
