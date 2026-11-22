<?php
// Prints the Publish box: save and preview buttons, status, visibility and date, and the publish or update button.
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
$html = guide_render( fn() => post_submit_meta_box( $GLOBALS['post'] ) );
return array( str_contains( $html, 'id="submitpost"' ), str_contains( $html, 'id="publish"' ) );
