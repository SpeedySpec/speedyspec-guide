<?php
// Whether content URLs must use HTTPS; given a value, sets it and gives the old one.
$was = force_ssl_content( true );
return array( $was, force_ssl_content() );
