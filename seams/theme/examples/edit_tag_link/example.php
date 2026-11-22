<?php
// Prints a link to edit the current tag, for users who can.
$tag = wp_insert_term( 'Red', 'post_tag' )['term_id'];
return guide_render( fn() => edit_tag_link( 'Edit tag', '[', ']', get_term( $tag ) ) );
