<?php
// Removes a script module, from the queue too.
wp_enqueue_script_module( '@guide/app', 'https://cdn.example/app.js' );
wp_deregister_script_module( '@guide/app' );
return guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) );
