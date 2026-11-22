<?php
// A user setting: the site-specific meta ({prefix}{name}) first, then the global meta, then a user field; get_user_option_{$option} filters it. update_user_option() and delete_user_option() write it, globally or for the site.
update_user_option( 1, 'layout', 'wide' );
update_user_option( 1, 'layout_global', 'narrow', true );
return array( get_user_option( 'layout', 1 ), get_user_meta( 1, 'guide_layout', true ), get_user_option( 'layout_global', 1 ), get_user_option( 'user_email', 1 ), get_user_option( 'nope', 1 ) );
