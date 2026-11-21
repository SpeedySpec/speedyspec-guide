<?php
// A tag name with spaces or characters such as & / < > [ ] = is refused and reported.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
add_shortcode( 'bad tag', fn() => 'x' );
return shortcode_exists( 'bad tag' );
