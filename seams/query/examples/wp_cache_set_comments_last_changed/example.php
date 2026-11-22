<?php
// Bumps the comment queries' last changed time, so cached queries refresh.
wp_cache_set_comments_last_changed();
return is_string( wp_cache_get( 'last_changed', 'comment' ) );
