<?php
// Removes a registered site meta key.
register_site_meta( 'color', array( 'type' => 'string' ) );
return array( unregister_site_meta( 'color' ), registered_meta_key_exists( 'blog', 'color' ) );
