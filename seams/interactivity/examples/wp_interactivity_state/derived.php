<?php
// A closure in the state is derived state: it is called when a directive reads it, and can omit the namespace.
wp_interactivity_state( 'my-plugin', array( 'n' => 3, 'double' => fn() => wp_interactivity_state()['n'] * 2 ) );
return wp_interactivity_process_directives( '<b data-wp-interactive="my-plugin" data-wp-text="state.double"></b>' );
