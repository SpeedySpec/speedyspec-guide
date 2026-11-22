<?php
// Whether the main query's Loop is running.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( '/' );
$before = in_the_loop();
the_post();
return array( $before, in_the_loop() );
