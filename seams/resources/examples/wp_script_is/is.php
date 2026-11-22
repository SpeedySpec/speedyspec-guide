<?php
// Whether a script is in a list: enqueued (the default), registered, to_do or done; enqueued counts scripts queued through dependencies.
wp_register_script( 'guide-a', 'a.js' );
wp_enqueue_script( 'guide-b', 'b.js', array( 'guide-a' ) );
return array( wp_script_is( 'guide-a' ), wp_script_is( 'guide-a', 'registered' ), wp_script_is( 'guide-b', 'done' ) );
