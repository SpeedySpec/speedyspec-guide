<?php
// Takes a script off the queue, keeping it registered.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
wp_enqueue_script( 'guide-app' );
wp_dequeue_script( 'guide-app' );
return array( wp_script_is( 'guide-app', 'enqueued' ), wp_script_is( 'guide-app', 'registered' ) );
