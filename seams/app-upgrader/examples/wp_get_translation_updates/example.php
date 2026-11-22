<?php
// The translation updates WordPress.org offers for core, plugins and themes, from their update transients.
set_site_transient( 'update_plugins', (object) array( 'response' => array(), 'translations' => array( array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' ) ) ) );
return wp_get_translation_updates();
