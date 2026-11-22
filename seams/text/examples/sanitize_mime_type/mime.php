<?php
// Keeps letters, digits and - + * . /; sanitize_mime_type gets the result and the original.
add_filter( 'sanitize_mime_type', fn( $s, $m ) => "$s|$m", 10, 2 );
return sanitize_mime_type( 'image/png; x="1"' );
