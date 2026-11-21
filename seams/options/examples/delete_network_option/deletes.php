<?php
// Deletes the network's row and returns true.
return array( delete_network_option( 1, 'site_name' ), get_network_option( 1, 'site_name' ) );
