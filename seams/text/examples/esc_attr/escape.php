<?php
// The same escaping as esc_html(), for attribute values, through attribute_escape.
add_filter( 'attribute_escape', fn( $safe, $text ) => "[$safe]", 10, 2 );
return esc_attr( '"a" & b' );
