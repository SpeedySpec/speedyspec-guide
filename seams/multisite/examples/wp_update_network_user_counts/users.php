<?php
// Counts a network's users into its user_count option.
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
wp_update_network_user_counts();
return get_network_option( 1, 'user_count' );
