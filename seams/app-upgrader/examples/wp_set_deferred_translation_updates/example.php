<?php
// Stores the translation updates to install later, by ID, in the deferred_translation_updates network option; an empty list deletes it.
wp_set_deferred_translation_updates( array( array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' ) ) );
$stored = array_values( get_site_option( 'deferred_translation_updates' ) );
wp_set_deferred_translation_updates( array() );
return array( $stored, get_site_option( 'deferred_translation_updates' ) );
