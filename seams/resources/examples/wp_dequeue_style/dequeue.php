<?php
// Takes a stylesheet off the queue, keeping it registered.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
wp_enqueue_style( 'guide-style' );
wp_dequeue_style( 'guide-style' );
return array( wp_style_is( 'guide-style' ), wp_style_is( 'guide-style', 'registered' ) );
