<?php
// Adds features (editor, thumbnail, custom-fields and the rest) to a post type, with optional arguments.
add_post_type_support( 'page', array( 'excerpt', 'guide-feature' ) );
return array( post_type_supports( 'page', 'excerpt' ), post_type_supports( 'page', 'guide-feature' ) );
