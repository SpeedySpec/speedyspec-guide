<?php
// The one WP_Interactivity_API, kept in $wp_interactivity.
return array( get_class( wp_interactivity() ), wp_interactivity() === $GLOBALS['wp_interactivity'] );
