<?php
// A user's drafts, newest first.
wp_insert_post( array( 'post_title' => 'Unfinished', 'post_status' => 'draft' ) );
return wp_list_pluck( get_users_drafts( 1 ), 'post_title' );
