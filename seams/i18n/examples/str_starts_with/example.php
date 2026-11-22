<?php
// PHP 8's str_starts_with(), which WordPress defines when PHP lacks it.
return array( str_starts_with( 'wp_options', 'wp_' ), str_starts_with( 'x', 'y' ), str_starts_with( 'x', '' ) );
