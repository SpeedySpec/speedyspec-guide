<?php
// Each call merges into a namespace's configuration and returns all of it.
wp_interactivity_config( 'my-plugin', array( 'a' => 1 ) );
return wp_interactivity_config( 'my-plugin', array( 'b' => 2 ) );
