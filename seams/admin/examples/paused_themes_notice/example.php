<?php
// Prints the admin notice that a theme was paused by recovery mode, on the themes screen.
$GLOBALS['pagenow'] = 'themes.php';
return guide_render( 'paused_themes_notice' );
