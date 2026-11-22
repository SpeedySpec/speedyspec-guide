<?php
// Prints the user's three most recent drafts under Quick Draft.
wp_insert_post( array( 'post_title' => 'Unfinished tea notes', 'post_status' => 'draft' ) );
return str_contains( guide_render( fn() => wp_dashboard_recent_drafts() ), 'Unfinished tea notes' );
