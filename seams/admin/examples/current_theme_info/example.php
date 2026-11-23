<?php
// Deprecated in 3.4.0; use wp_get_theme(). Gave the active theme's details.
list( $result, $notice ) = guide_deprecated( 'current_theme_info' );
return array( $result->get( 'Name' ), $notice );
