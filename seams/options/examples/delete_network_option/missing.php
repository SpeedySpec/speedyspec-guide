<?php
// pre_delete_site_option_{$option} fires even when there is nothing to delete.
function guide_announce_pre_delete_site_option() {
	echo 'pre_delete_site_option_guide_missing ';
}
add_action( 'pre_delete_site_option_guide_missing', 'guide_announce_pre_delete_site_option' );
return delete_network_option( 1, 'guide_missing' );
