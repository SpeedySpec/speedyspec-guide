<?php
// The pending translation updates, as data for the updates screen's script.
set_site_transient( 'update_plugins', (object) array( 'response' => array(), 'translations' => array( array( 'type' => 'plugin', 'slug' => 'hello', 'language' => 'fr_FR', 'version' => '1.7' ) ) ) );
return count( wp_get_translation_update_data() );
