<?php
// Removes a feature from a post type.
remove_post_type_support( 'post', 'comments' );
return post_type_supports( 'post', 'comments' );
