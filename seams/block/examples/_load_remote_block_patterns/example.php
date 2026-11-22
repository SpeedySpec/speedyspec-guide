<?php
// Hooked to current_screen in the editor: registers the core patterns from the pattern directory, when should_load_remote_block_patterns allows.
add_filter( 'should_load_remote_block_patterns', '__return_false' );
return _load_remote_block_patterns();
