<?php
// Prints the queued scripts (or those given) with their dependencies, firing wp_print_scripts first; gives the handles printed.
wp_register_script( 'guide-a', 'https://cdn.example/a.js', array(), null );
wp_register_script( 'guide-b', 'https://cdn.example/b.js', array( 'guide-a' ), null );
ob_start();
$done = wp_print_scripts( 'guide-b' );
$html = ob_get_clean();
return array( $done, substr_count( $html, '<script' ) );
