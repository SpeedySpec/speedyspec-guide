<?php
// One block template by theme//slug: the user's saved one, else the theme's file or a registered one; filtered by get_block_template.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$template = get_block_template( 'twentytwentyfive//single' );
return array( $template->slug, $template->source );
