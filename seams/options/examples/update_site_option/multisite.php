<?php
// Updates a network option of the current network.
update_site_option( 'site_name', 'Renamed' );
return get_network_option( 1, 'site_name' );
