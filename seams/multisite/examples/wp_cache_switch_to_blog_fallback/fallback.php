<?php
// Switches the object cache to another site by reinitializing it and restoring its global and non-persistent groups, for cache drop-ins without a switch_to_blog() method.
wp_cache_add_global_groups( array( 'guide-global' ) );
wp_cache_switch_to_blog_fallback();
return in_array( 'guide-global', array_keys( $GLOBALS['wp_object_cache']->global_groups ), true ) || in_array( 'guide-global', (array) $GLOBALS['wp_object_cache']->global_groups, true );
