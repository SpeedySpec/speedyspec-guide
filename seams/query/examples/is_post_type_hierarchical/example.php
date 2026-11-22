<?php
// Whether a post type is hierarchical, like pages.
return array( is_post_type_hierarchical( 'page' ), is_post_type_hierarchical( 'post' ), is_post_type_hierarchical( 'nope' ) );
