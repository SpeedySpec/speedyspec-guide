<?php
// The Media Library's view, grid or list: from ?mode=, else the user's saved choice, else grid.
$default = wp_get_media_library_mode();
update_user_option( get_current_user_id(), 'media_library_mode', 'list' );
$saved = wp_get_media_library_mode();
$_GET['mode'] = 'grid';
return array( $default, $saved, wp_get_media_library_mode() );
