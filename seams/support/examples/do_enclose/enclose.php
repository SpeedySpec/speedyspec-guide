<?php
// Adds enclosure meta for audio and video links in a post's content, after checking each link's headers; links already enclosed and those in pung are skipped. Here every request is blocked, so none are added.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp_update_post( array( 'ID' => $post, 'post_content' => '<a href="https://media.example/a.mp3">a</a>' ) );
do_enclose( null, $post );
return get_post_meta( $post, 'enclosure' );
