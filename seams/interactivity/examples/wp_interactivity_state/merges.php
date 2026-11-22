<?php
// Each call merges into a namespace's state and returns all of it.
wp_interactivity_state( 'my-plugin', array( 'a' => 1, 'list' => array( 'x' => 1 ) ) );
return wp_interactivity_state( 'my-plugin', array( 'list' => array( 'y' => 2 ) ) );
