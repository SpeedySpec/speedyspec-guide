<?php
// The table names of the site or network, by group (blog, global, ms_global, old, all), prefixed or not; set_prefix() and set_blog_id() change them.
global $wpdb;
return array( $wpdb->prefix, $wpdb->posts, array_slice( $wpdb->tables( 'blog', false ), 0, 4 ), $wpdb->get_blog_prefix( 3 ), $wpdb->has_cap( 'collation' ) );
