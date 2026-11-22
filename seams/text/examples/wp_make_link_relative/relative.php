<?php
// Drops the scheme and host, keeping the path, query and fragment.
return array( wp_make_link_relative( 'https://example.com/a/b?c=1#d' ), wp_make_link_relative( '//example.com' ), wp_make_link_relative( '/already' ) );
