<?php
// The default comment or ping status for a post type: open when the type supports it and the site's default is open, else closed; filtered by get_default_comment_status.
update_option( 'default_ping_status', 'closed' );
return array( get_default_comment_status( 'post' ), get_default_comment_status( 'post', 'pingback' ), get_default_comment_status( 'page' ) );
