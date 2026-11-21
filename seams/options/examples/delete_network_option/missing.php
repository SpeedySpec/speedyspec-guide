<?php
// pre_delete_site_option_{$option} fires even when there is nothing to delete.
add_action( 'pre_delete_site_option_guide_missing', function () { echo 'pre_delete_site_option_guide_missing '; } );
return delete_network_option( 1, 'guide_missing' );
