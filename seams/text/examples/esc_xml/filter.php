<?php
// esc_xml gets the escaped text and the original.
add_filter( 'esc_xml', fn( $safe, $text ) => "[$safe]", 10, 2 );
return esc_xml( '"' );
