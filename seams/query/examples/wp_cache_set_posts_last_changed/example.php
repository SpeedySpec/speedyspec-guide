<?php
// Bumps the posts' last changed time, so cached queries refresh.
wp_cache_set_posts_last_changed();
return is_string( wp_cache_get( 'last_changed', 'posts' ) );
