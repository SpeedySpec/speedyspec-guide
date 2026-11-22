<?php
// Prints the scripts queued for the head, firing wp_print_scripts first unless it already ran; gives the handles printed.
wp_enqueue_script( 'guide-head', 'https://cdn.example/head.js', array(), null );
ob_start();
$done = print_head_scripts();
$html = ob_get_clean();
return array( in_array( 'guide-head', $done, true ), str_contains( $html, 'head.js' ) );
