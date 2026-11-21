<?php
// Every option stored with an autoload value that loads, keyed by name.
$names = array_keys( wp_load_alloptions() );
sort( $names );
return $names;
