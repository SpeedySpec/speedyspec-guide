<?php
// Prints the queued styles (or those given) as link tags, firing wp_print_styles first; gives the handles printed.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
ob_start();
$done = wp_print_styles( 'guide-style' );
$html = trim( ob_get_clean() );
return array( $done, $html );
