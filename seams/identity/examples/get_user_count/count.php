<?php
// The network's user count, from the user_count option kept by wp_update_user_counts(); on a single site, the users counted directly.
$grace = guide_user();
return array( get_user_count(), wp_update_user_counts(), wp_is_large_user_count() );
