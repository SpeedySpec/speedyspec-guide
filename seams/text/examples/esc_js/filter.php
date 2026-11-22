<?php
// js_escape gets the escaped text and the original.
add_filter( 'js_escape', fn( $safe, $text ) => "$safe|$text", 10, 2 );
return esc_js( 'a' );
