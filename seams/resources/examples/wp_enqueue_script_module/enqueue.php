<?php
// Queues a script module, registering it first when a source is given; enqueued modules print as script type=module tags.
wp_enqueue_script_module( '@guide/app', 'https://cdn.example/app.js', array(), '1.0' );
return guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) );
