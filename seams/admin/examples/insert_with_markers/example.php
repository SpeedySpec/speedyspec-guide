<?php
// Writes lines into a file between # BEGIN and # END marker comments, replacing what was between them before; gives whether it wrote.
$file = wp_tempnam( 'htaccess' );
file_put_contents( $file, "# Other rules\n" );
insert_with_markers( $file, 'Tea', array( 'RewriteRule ^tea$ /index.php [L]' ) );
$contents = file_get_contents( $file );
unlink( $file );
return str_contains( $contents, "# BEGIN Tea" ) && str_contains( $contents, "RewriteRule ^tea$ /index.php [L]\n# END Tea" );
