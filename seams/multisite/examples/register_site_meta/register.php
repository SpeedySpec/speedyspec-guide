<?php
// Registers a site meta key with its type, description, single and sanitize callback.
register_site_meta( 'color', array( 'type' => 'string', 'single' => true ) );
return registered_meta_key_exists( 'blog', 'color' );
