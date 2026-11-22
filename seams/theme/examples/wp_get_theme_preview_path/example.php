<?php
// Hooked to stylesheet and template while previewing a block theme: the previewed theme from wp_theme_preview, for users who can switch themes.
$_GET['wp_theme_preview'] = 'twentytwentyfive';
return array( wp_get_theme_preview_path( 'guide' ), wp_get_theme_preview_path() );
