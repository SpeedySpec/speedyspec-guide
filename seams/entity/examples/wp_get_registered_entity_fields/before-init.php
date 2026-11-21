<?php
// Reading before init has completed is reported, and finds nothing.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
return wp_get_registered_entity_fields( 'postType', 'book' );
