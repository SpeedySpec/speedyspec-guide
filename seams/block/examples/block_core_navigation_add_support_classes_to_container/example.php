<?php
// Adds the Navigation block's support classes to its inner list containers.
$block = array( 'blockName' => 'core/navigation', 'attrs' => array() );
$html = '<nav class="wp-block-navigation"><ul class="wp-block-navigation__container"></ul></nav>';
return array( block_core_navigation_add_support_classes_to_container( $html, $block ) === $html, block_core_navigation_add_support_classes_to_container( '', $block ) );
