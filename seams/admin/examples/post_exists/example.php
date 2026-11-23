<?php
// The ID of a post matching a title, and optionally content, date, type and status, or 0.
wp_insert_post( array( 'post_title' => 'Oolong notes', 'post_status' => 'publish' ) );
return array( post_exists( 'Oolong notes' ) > 0, post_exists( 'Nothing like it' ) );
