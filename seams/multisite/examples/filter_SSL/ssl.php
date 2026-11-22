<?php
// Gives a URL the https scheme, whatever scheme it had, when content is forced to HTTPS and the request is secure.
force_ssl_content( true );
$_SERVER['HTTPS'] = 'on';
return array( filter_SSL( 'http://example.org/a.jpg' ), filter_SSL( 'ftp://example.org/x' ) );
