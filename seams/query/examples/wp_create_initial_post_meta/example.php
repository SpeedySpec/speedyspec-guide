<?php
// Registers the post meta WordPress uses: wp_pattern_sync_status for synced patterns, partial or unsynced, shown in REST.
wp_create_initial_post_meta();
return get_registered_meta_keys( 'post', 'wp_block' )['wp_pattern_sync_status']['show_in_rest']['schema']['enum'];
