<?php
// Prints the Events part of the Events and News widget, with the location form, filled in by script.
return str_contains( guide_render( 'wp_print_community_events_markup' ), 'community-events-location' );
