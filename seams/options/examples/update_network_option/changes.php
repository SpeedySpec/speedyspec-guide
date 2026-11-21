<?php
// Saves a new value and returns true.
return array( update_network_option( 1, 'site_name', 'Renamed' ), get_network_option( 1, 'site_name' ) );
