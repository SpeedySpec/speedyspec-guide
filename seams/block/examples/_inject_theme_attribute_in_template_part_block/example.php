<?php
// Adds the theme to a template part block that lacks one, so it resolves.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$block = array( 'blockName' => 'core/template-part', 'attrs' => array( 'slug' => 'header' ), 'innerBlocks' => array() );
_inject_theme_attribute_in_template_part_block( $block );
return $block['attrs'];
