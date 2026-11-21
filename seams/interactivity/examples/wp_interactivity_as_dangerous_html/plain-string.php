<?php
// A plain string is not rendered: the element is emptied, and the mistake reported.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
wp_interactivity_state( 'my-plugin', array( 'html' => '<b>bold</b>' ) );
return wp_interactivity_process_directives( '<div data-wp-interactive="my-plugin"><div data-wp-html="state.html">old</div></div>' );
