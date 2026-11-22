<?php
// Hooked to heartbeat_settings: lets the Heartbeat API pause when the page is inactive, except on the post editor.
$GLOBALS['pagenow'] = 'index.php';
return wp_heartbeat_set_suspension( array() );
