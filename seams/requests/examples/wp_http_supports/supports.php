<?php
// Whether a transport supports the capabilities; an https URL asks for ssl.
return array( wp_http_supports(), wp_http_supports( array( 'ssl' ) ), wp_http_supports( array(), 'https://example.org/' ) );
