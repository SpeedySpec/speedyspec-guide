<?php
// A post's preview URL, its permalink with preview=true; filtered by preview_post_link.
$draft = wp_insert_post( array( 'post_title' => 'Draft' ) );
return get_preview_post_link( $draft );
