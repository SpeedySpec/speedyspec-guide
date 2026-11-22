<?php
// Updates the user count unless the network is large and enable_live_network_counts says no.
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
wp_maybe_update_network_user_counts();
return get_network_option( 1, 'user_count' );
