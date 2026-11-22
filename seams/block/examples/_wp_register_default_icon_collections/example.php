<?php
// Hooked to init: registers the core and core-admin icon collections.
_wp_register_default_icon_collections();
$registry = WP_Icon_Collections_Registry::get_instance();
return array( $registry->is_registered( 'core' ), $registry->is_registered( 'core-admin' ) );
