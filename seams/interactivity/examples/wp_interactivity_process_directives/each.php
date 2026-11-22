<?php
// data-wp-each repeats a template's content for each item of a list, marking each copy.
wp_interactivity_state( 'my-plugin', array( 'items' => array( 'a', 'b' ) ) );
return wp_interactivity_process_directives( '<ul data-wp-interactive="my-plugin"><template data-wp-each="state.items"><li data-wp-text="context.item"></li></template></ul>' );
