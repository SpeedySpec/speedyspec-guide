<?php
// Records a post type's meta capabilities, such as edit_book for edit_post, so map_meta_cap() maps them like the post ones.
_post_type_meta_capabilities( array( 'edit_post' => 'edit_book' ) );
global $post_type_meta_caps;
return $post_type_meta_caps['edit_book'];
