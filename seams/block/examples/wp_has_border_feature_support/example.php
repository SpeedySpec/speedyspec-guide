<?php
// Whether a block type supports a border feature (color, radius, style, width), honouring the old color.__experimentalSkipSerialization.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
return array( wp_has_border_feature_support( $type, 'radius' ), wp_has_border_feature_support( $type, 'nope' ) );
