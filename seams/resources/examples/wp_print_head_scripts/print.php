<?php
// Prints the head scripts on the front end, firing wp_print_scripts first unless it already ran; on wp_head.
wp_enqueue_script( 'guide-head', 'https://cdn.example/head.js', array(), null );
return str_contains( guide_render( 'wp_print_head_scripts' ), 'head.js' );
