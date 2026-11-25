<?php
// The meta keys registered for a type and subtype, with their arguments.
register_meta( 'post', 'a', array( 'type' => 'string' ) );
register_meta( 'post', 'b', array( 'type' => 'integer', 'object_subtype' => 'page' ) );
return array( array_keys( get_registered_meta_keys( 'post' ) ), array_keys( get_registered_meta_keys( 'post', 'page' ) ), get_registered_meta_keys( 'nope' ) );
