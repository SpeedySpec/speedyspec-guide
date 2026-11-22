<?php
// Unregisters an icon.
wp_register_icon_collection( 'my-plugin', array( 'label' => 'My Plugin' ) );
wp_register_icon( 'my-plugin/dot', array( 'label' => 'Dot', 'content' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>' ) );
wp_unregister_icon( 'my-plugin/dot' );
return WP_Icons_Registry::get_instance()->is_registered( 'my-plugin/dot' );
