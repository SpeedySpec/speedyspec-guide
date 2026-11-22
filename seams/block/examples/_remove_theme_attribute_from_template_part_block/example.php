<?php
// Removes the theme from a template part block, for exports.
$block = array( 'blockName' => 'core/template-part', 'attrs' => array( 'slug' => 'header', 'theme' => 'x' ), 'innerBlocks' => array() );
_remove_theme_attribute_from_template_part_block( $block );
return $block['attrs'];
