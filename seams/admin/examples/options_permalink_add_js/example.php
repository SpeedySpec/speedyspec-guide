<?php
// Deprecated in 4.9.0. Printed the Permalink Settings screen's script; now prints nothing.
list( $result, $notice ) = guide_deprecated( 'options_permalink_add_js' );
return str_contains( $notice, 'permalink-structure' );
