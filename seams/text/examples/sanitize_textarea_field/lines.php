<?php
// The same as sanitize_text_field(), keeping line breaks; sanitize_textarea_field filters it.
add_filter( 'sanitize_textarea_field', fn( $filtered, $str ) => "[$filtered]", 10, 2 );
return sanitize_textarea_field( "<b>a</b>\nb  c" );
