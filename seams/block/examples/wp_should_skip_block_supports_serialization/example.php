<?php
// Whether a block type asks WordPress not to put a support's classes and styles on its wrapper (__experimentalSkipSerialization), for the whole feature or one part.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'color' => array( 'text' => true, '__experimentalSkipSerialization' => array( 'text' ) ) ) ) );
return array( wp_should_skip_block_supports_serialization( $type, 'color', 'text' ), wp_should_skip_block_supports_serialization( $type, 'color', 'background' ) );
