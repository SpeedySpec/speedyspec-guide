<?php
// Whether a block type supports a feature, by a path into its supports.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return array( block_has_support( $type, 'color' ), block_has_support( $type, array( 'typography', 'fontSize' ) ), block_has_support( $type, 'nope' ) );
