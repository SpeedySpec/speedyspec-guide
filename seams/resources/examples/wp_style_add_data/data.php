<?php
// Adds data to a stylesheet: rtl (true, replace or a URL), suffix, alt, title, path (to inline it), conditional.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
wp_style_add_data( 'guide-style', 'rtl', 'replace' );
return array( wp_styles()->get_data( 'guide-style', 'rtl' ), wp_style_add_data( 'nope', 'rtl', true ) );
