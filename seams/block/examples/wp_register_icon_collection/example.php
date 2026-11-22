<?php
// Registers an icon collection by slug, with its label and description.
wp_register_icon_collection( 'my-plugin', array( 'label' => 'My Plugin' ) );
return WP_Icon_Collections_Registry::get_instance()->is_registered( 'my-plugin' );
