<?php
// Counts the users and stores the count in the network's user_count option; returns whether it saved, false when the count is unchanged.
$grace = guide_user();
return array( wp_update_user_counts(), get_network_option( null, 'user_count' ) );
