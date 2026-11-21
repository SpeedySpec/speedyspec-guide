<?php
// esc_html gets the escaped text and the original.
add_filter( 'esc_html', fn( $safe, $text ) => strlen( $safe ) . ':' . $text, 10, 2 );
return esc_html( '<' );
