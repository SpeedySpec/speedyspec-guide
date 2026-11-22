<?php
// Splits translation updates into those the user chose to install now and those to put off, storing the latter as deferred.
set_site_transient( 'update_plugins', (object) array( 'response' => array(), 'translations' => array( array( 'type' => 'plugin', 'slug' => 'hello', 'language' => 'fr_FR', 'version' => '1.7' ), array( 'type' => 'plugin', 'slug' => 'hello', 'language' => 'de_DE', 'version' => '1.7' ) ) ) );
$ids = array_keys( wp_get_translation_updates_by_id() );
$selected = wp_process_translation_update_selection( $ids, array( $ids[0] ) );
return array( count( $selected ), count( wp_get_deferred_translation_updates() ) );
