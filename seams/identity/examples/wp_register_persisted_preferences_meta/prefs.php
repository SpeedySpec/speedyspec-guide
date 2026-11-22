<?php
// Registers the persisted_preferences user meta (the block editor's preferences), an object shown in the REST API.
wp_register_persisted_preferences_meta();
$meta = get_registered_meta_keys( 'user' )[ $GLOBALS['wpdb']->get_blog_prefix() . 'persisted_preferences' ];
return array( $meta['type'], $meta['single'], $meta['show_in_rest']['schema']['type'] );
