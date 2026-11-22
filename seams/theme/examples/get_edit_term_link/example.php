<?php
// A term's edit screen URL, for users who can edit it; filtered by get_edit_term_link.
$tag = wp_insert_term( 'Red', 'post_tag' )['term_id'];
$admin = get_edit_term_link( $tag, 'post_tag' );
wp_set_current_user( 0 );
return array( $admin, get_edit_term_link( $tag, 'post_tag' ) );
