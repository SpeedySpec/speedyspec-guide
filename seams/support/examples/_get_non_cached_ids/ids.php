<?php
// The IDs not in a cache group yet, each valid one once; invalid IDs get a doing-it-wrong notice.
wp_cache_set( 3, 'x', 'guide' );
return _get_non_cached_ids( array( 3, 4, '5', 4 ), 'guide' );
