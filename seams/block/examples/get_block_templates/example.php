<?php
// The block templates or parts of the active theme: the user's saved posts over the theme's files and plugins' registered templates; filtered by pre_get_block_templates and get_block_templates.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$ids = wp_list_pluck( get_block_templates(), 'id' );
return array( in_array( 'twentytwentyfive//index', $ids, true ), count( get_block_templates( array(), 'wp_template_part' ) ) > 0 );
