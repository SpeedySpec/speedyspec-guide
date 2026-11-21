<?php
// Adds a network option to the current network.
add_site_option( 'guide_net', 'v' );
return get_network_option( 1, 'guide_net' );
