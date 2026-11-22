<?php
// Puts wpautop back on the_content after do_blocks() took it off for block content.
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', '_restore_wpautop_hook', 10 );
_restore_wpautop_hook( 'x' );
return has_filter( 'the_content', 'wpautop' );
