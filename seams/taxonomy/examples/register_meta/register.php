<?php
// Registers a meta key for a type (and optionally an object subtype): its type, description, single, default, sanitize and auth callbacks and REST exposure; register_meta_args filters them (WordPress attaches _wp_register_meta_args_allowed_list, which drops unknown ones; not here, so 'extra' stays). It is false with a mistake reported for show_in_rest without a schema an array needs, or a default of the wrong type.
add_action( 'doing_it_wrong_run', fn( $f ) => print( "doing_it_wrong_run $f\n" ) );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
$ok = register_meta( 'post', 'rating', array( 'type' => 'integer', 'single' => true, 'default' => 3, 'object_subtype' => 'post', 'extra' => 1 ) );
$registered = get_registered_meta_keys( 'post', 'post' )['rating'];
$bad = register_meta( 'post', 'tags', array( 'type' => 'array', 'show_in_rest' => true ) );
return array( $ok, array_keys( $registered ), $registered['default'], $bad );
