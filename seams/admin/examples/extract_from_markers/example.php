<?php
// The lines of a file between its # BEGIN and # END markers of a name.
$file = wp_tempnam( 'htaccess' );
insert_with_markers( $file, 'Tea', array( 'Line one', 'Line two' ) );
$lines = extract_from_markers( $file, 'Tea' );
unlink( $file );
return array_values( array_filter( $lines, fn( $line ) => ! str_starts_with( $line, '#' ) ) );
