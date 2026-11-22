<?php
// A unique wp-settings-... class name for a block that defines its own presets.
return (bool) preg_match( '/^wp-settings-[0-9a-f]+$/', _wp_get_presets_class_name( array( 'blockName' => 'core/group', 'attrs' => array( 'settings' => array( 'color' => array() ) ) ) ) );
