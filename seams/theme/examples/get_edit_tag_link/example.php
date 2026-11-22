<?php
// A tag's edit screen URL; get_edit_term_link() for it.
$tag = wp_insert_term( 'Red', 'post_tag' )['term_id'];
return get_edit_tag_link( $tag );
