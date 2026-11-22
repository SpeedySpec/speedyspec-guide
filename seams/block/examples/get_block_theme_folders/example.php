<?php
// A theme's block template and part folders: templates and parts, or the older block-templates and block-template-parts.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
return array( get_block_theme_folders(), get_block_theme_folders( 'twentytwentyone' ) );
