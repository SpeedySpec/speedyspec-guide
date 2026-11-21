<?php
// On trunk, data-wp-html renders HTML from the store only when it is marked as trusted.
wp_interactivity_state( 'my-plugin', array( 'html' => wp_interactivity_as_dangerous_html( '<b>bold</b>' ) ) );
return wp_interactivity_process_directives( '<div data-wp-interactive="my-plugin"><div data-wp-html="state.html">old</div></div>' );
