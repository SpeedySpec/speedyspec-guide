<?php
// A network option that isn't stored is added; on a single site, as an option.
update_network_option( null, 'guide_net', 'v' );
return get_option( 'guide_net' );
