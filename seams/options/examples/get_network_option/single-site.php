<?php
// On a single site, a network option is an ordinary option.
add_option( 'guide_net', 'v' );
return get_network_option( null, 'guide_net' );
