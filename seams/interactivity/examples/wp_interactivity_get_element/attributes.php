<?php
// The element whose directives are running, with its attributes.
wp_interactivity_state( 'my-plugin', array( 'id' => fn() => wp_interactivity_get_element()['attributes']['id'] ) );
return wp_interactivity_process_directives( '<p id="intro" data-wp-interactive="my-plugin" data-wp-text="state.id"></p>' );
