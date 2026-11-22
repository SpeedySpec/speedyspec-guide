<?php
// Adds the default network options of a new network, such as site_name and the upload limits, over the values given.
populate_network_meta( 1, array( 'site_name' => 'Tea Network' ) );
return array( get_network_option( 1, 'site_name' ), get_network_option( 1, 'fileupload_maxk' ) );
