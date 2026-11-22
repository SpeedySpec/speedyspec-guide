<?php
// Clears the cached is_multi_author() answer, when posts change.
is_multi_author();
__clear_multi_author_cache();
return wp_cache_get( 'is_multi_author', 'posts' );
