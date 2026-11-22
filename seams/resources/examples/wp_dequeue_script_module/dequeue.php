<?php
// Takes a script module off the queue, keeping it registered.
wp_enqueue_script_module( '@guide/app', 'https://cdn.example/app.js' );
wp_dequeue_script_module( '@guide/app' );
return guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) );
