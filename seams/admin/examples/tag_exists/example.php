<?php
// The ID of a tag with a name or slug, or null.
wp_insert_term( 'oolong', 'post_tag' );
return array( is_array( tag_exists( 'oolong' ) ), tag_exists( 'nope' ) );
