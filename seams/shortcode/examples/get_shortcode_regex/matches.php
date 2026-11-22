<?php
// The regular expression do_shortcode() uses, for the registered tags or the ones given.
preg_match( '/' . get_shortcode_regex( array( 'greet' ) ) . '/', 'x [greet name=Ada]hi[/greet] y', $m );
return array( $m[2], trim( $m[3] ), $m[5] );
