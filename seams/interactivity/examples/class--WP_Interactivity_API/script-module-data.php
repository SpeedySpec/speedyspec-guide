<?php
// With its hooks added, the state and config reach the @wordpress/interactivity script module's data.
wp_interactivity()->add_hooks();
wp_interactivity_state( 'my-plugin', array( 'count' => 1 ) );
wp_interactivity_config( 'my-plugin', array( 'debug' => true ) );
return apply_filters( 'script_module_data_@wordpress/interactivity', array() );
