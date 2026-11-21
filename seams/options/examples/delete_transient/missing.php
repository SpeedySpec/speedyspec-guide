<?php
// delete_transient_{$transient} fires even when there is nothing to delete; deleted_transient doesn't.
add_action( 'delete_transient_guide_missing', function () { echo 'delete_transient_guide_missing '; } );
add_action( 'deleted_transient', function () { echo 'deleted_transient '; } );
return delete_transient( 'guide_missing' );
