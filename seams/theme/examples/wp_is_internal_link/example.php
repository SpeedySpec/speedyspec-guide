<?php
// Whether a URL points to one of this site's hosts.
return array( wp_is_internal_link( 'http://example.org/about' ), wp_is_internal_link( 'https://wordpress.org/' ) );
