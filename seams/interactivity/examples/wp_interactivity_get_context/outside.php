<?php
// Outside directive processing there is no context.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
return wp_interactivity_get_context( 'my-plugin' );
