<?php
// Calling the constructor directly is reported: use create_fragment() or create_full_parser().
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
new WP_HTML_Processor( '<p>' );
