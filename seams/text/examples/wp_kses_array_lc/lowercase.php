<?php
// Lowercases the keys of an allowed-HTML array and of each element's attributes.
return wp_kses_array_lc( array( 'A' => array( 'HREF' => true ) ) );
