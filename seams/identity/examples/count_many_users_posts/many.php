<?php
// Published post counts for several users at once, by user ID.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
return count_many_users_posts( array( 1, $grace ) );
