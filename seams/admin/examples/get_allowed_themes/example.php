<?php
// Deprecated in 3.4.0. Gave the themes allowed on the site, by name.
list( $result, $notice ) = guide_deprecated( 'get_allowed_themes' );
return array( array_keys( $result ), $notice );
