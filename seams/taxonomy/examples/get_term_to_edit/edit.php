<?php
// A term's fields escaped for an edit form; a missing term gives a WP_Error from get_term() or ''.
$id = wp_insert_term( 'Fish & <Chips>', 'post_tag' )['term_id'];
return array( get_term_to_edit( $id, 'post_tag' )->name, get_term_to_edit( 999, 'post_tag' ) );
