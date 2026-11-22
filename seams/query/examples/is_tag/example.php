<?php
// Whether the main query is for a tag archive, optionally of given tags.
wp_insert_term( 'Red', 'post_tag' );
guide_go( '/?tag=red' );
return array( is_tag(), is_tag( 'red' ), is_category() );
