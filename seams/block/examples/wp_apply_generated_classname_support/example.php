<?php
// The wp-block-{name} class a block gets unless its supports turn className off (the Paragraph block adds its own class instead).
$group = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
$paragraph = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return array( wp_apply_generated_classname_support( $group ), wp_apply_generated_classname_support( $paragraph ) );
