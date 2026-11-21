<?php
// data-wp-text sets an element's content from the store, escaped.
wp_interactivity_state( 'my-plugin', array( 'message' => 'Hi <b>' ) );
return wp_interactivity_process_directives( '<div data-wp-interactive="my-plugin"><span data-wp-text="state.message">old</span></div>' );
