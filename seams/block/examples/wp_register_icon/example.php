<?php
// Registers an icon by collection/name, with its label, SVG content or file, and keywords.
wp_register_icon_collection( 'my-plugin', array( 'label' => 'My Plugin' ) );
wp_register_icon( 'my-plugin/dot', array( 'label' => 'Dot', 'content' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>' ) );
return WP_Icons_Registry::get_instance()->is_registered( 'my-plugin/dot' );
