<?php
// Reads the current element's context while directives run, for example in derived state.
wp_interactivity_state( 'my-plugin', array( 'greeting' => fn() => 'Hello, ' . wp_interactivity_get_context()['name'] ) );
return wp_interactivity_process_directives( '<p data-wp-interactive="my-plugin" data-wp-context=\'{"name":"Ada"}\' data-wp-text="state.greeting"></p>' );
