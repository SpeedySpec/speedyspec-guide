<?php
// delete_transient_{$transient} fires even when there is nothing to delete; deleted_transient doesn't.
function guide_announce_delete_transient() {
	echo 'delete_transient_guide_missing ';
}
add_action( 'delete_transient_guide_missing', 'guide_announce_delete_transient' );
function guide_announce_deleted_transient() {
	echo 'deleted_transient ';
}
add_action( 'deleted_transient', 'guide_announce_deleted_transient' );
return delete_transient( 'guide_missing' );
