<?php
// Unregisters an icon collection.
wp_register_icon_collection( 'my-plugin', array( 'label' => 'My Plugin' ) );
wp_unregister_icon_collection( 'my-plugin' );
return WP_Icon_Collections_Registry::get_instance()->is_registered( 'my-plugin' );
