<?php
// Outside wp_entity_fields_api_init nothing is registered.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
return wp_register_entity_fields( 'my-plugin', 'postType', 'book', array( array( 'id' => 'isbn' ) ) );
