<?php
// The core updates WordPress.org offers, from the update_core transient, leaving out dismissed ones unless asked.
guide_offer_core_update( '7.3' );
$updates = get_core_updates();
return array( count( $updates ), $updates[0]->response, $updates[0]->current );
