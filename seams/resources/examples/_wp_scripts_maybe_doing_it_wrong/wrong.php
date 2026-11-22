<?php
// Reports a doing-it-wrong notice, naming the handle, when a script or style function is called before init, wp_enqueue_scripts, admin_enqueue_scripts or login_enqueue_scripts has run; afterwards, as here, nothing.
add_action( 'doing_it_wrong_run', fn( $f ) => print( "$f was called too early\n" ) );
_wp_scripts_maybe_doing_it_wrong( 'wp_enqueue_script', 'mine' );
return did_action( 'init' );
