<?php
// Sets $wpdb's table prefix and column formats; stops the request when the prefix holds characters other than letters, digits and underscores.
wp_set_wpdb_vars();
return array( $GLOBALS['wpdb']->prefix, $GLOBALS['wpdb']->field_types['post_author'] );
