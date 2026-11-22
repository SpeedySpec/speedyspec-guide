<?php
// Whether the current site may edit a network: true for its own network.
return array( can_edit_network( get_current_network_id() ), can_edit_network( 99 ) );
