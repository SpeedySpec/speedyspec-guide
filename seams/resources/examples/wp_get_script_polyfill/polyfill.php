<?php
// Inline JavaScript that loads each polyfill script whose feature test fails, with document.write.
$s = wp_scripts();
return str_contains( wp_get_script_polyfill( $s, array( '"fetch" in window' => 'wp-polyfill-fetch' ) ), '( "fetch" in window ) || document.write(' );
