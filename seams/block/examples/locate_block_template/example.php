<?php
// Hooked to {$type}_template: for block themes, resolves the block template for the hierarchy and sets it as the template to render through the template canvas.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$GLOBALS['_wp_theme_features']['block-templates'] = true;
$template = locate_block_template( '', 'page', array( 'page.php' ) );
return array( basename( $template ), $GLOBALS['_wp_current_template_id'] );
