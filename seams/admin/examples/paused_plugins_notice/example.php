<?php
// Prints the admin notice listing plugins paused by recovery mode, on the plugins screen.
$GLOBALS['pagenow'] = 'plugins.php';
return guide_render( 'paused_plugins_notice' );
