<?php
// The post types that support a feature or all of several, or any with operator or.
return array( get_post_types_by_support( 'page-attributes' ), get_post_types_by_support( array( 'title', 'post-formats' ) ) );
