<?php
// Adds (Draft) to the titles of draft pages in the Privacy Policy page select, on the Privacy screen.
$page = get_post( wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Privacy', 'post_status' => 'draft' ) ) );
set_current_screen( 'privacy' );
return _wp_privacy_settings_filter_draft_page_titles( 'Privacy', $page );
