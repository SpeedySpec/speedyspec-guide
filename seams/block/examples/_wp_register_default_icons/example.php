<?php
// Hooked to init: registers the core and core-admin icons from their manifest.
_wp_register_default_icons();
return WP_Icons_Registry::get_instance()->is_registered( 'core/arrow-left' );
