<?php
// Registers the featured patterns from the pattern directory, when allowed.
add_filter( 'should_load_remote_block_patterns', '__return_false' );
return _load_remote_featured_patterns();
