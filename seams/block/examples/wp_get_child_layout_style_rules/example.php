<?php
// The CSS rules for a block inside a flex or grid parent: its self-stretch, column and row spans and start.
return wp_get_child_layout_style_rules( '.wp-container-content-1', array( 'selfStretch' => 'fixed', 'flexSize' => '200px' ), array( 'type' => 'flex' ) );
