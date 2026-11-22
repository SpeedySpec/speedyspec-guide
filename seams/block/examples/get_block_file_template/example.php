<?php
// A block template from the theme's files by theme//slug, ignoring saved ones; filtered by get_block_file_template.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
return get_block_file_template( 'twentytwentyfive//page' )->source;
