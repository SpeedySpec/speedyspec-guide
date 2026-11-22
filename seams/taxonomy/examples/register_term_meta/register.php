<?php
// Registers a meta key for terms of a taxonomy (or all with ''); unregister_term_meta() removes it.
$ok = register_term_meta( 'category', 'color', array( 'type' => 'string', 'single' => true ) );
$exists = registered_meta_key_exists( 'term', 'color', 'category' );
unregister_term_meta( 'category', 'color' );
return array( $ok, $exists, registered_meta_key_exists( 'term', 'color', 'category' ) );
