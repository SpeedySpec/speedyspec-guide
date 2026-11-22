<?php
// Prints (or gives) the post's title stripped of tags and escaped for an attribute.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
return the_title_attribute( array( 'echo' => false, 'before' => 'Link to ' ) );
