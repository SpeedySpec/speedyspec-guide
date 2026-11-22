<?php
// Hooks the default flood check, wp_check_comment_flood, to check_comment_flood.
check_comment_flood_db();
return has_filter( 'wp_is_comment_flood', 'wp_check_comment_flood' );
