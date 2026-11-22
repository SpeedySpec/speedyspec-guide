<?php
// Outside wp_entity_fields_api_init nothing is registered.
function guide_report_doing_it_wrong( $function_name ) { echo "$function_name "; }
add_action( 'doing_it_wrong_run', 'guide_report_doing_it_wrong' );
return wp_register_entity_fields( 'my-plugin', 'postType', 'book', array( array( 'id' => 'isbn' ) ) );
