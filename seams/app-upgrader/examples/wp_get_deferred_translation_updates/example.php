<?php
// The translation updates put off to install later, by ID, from the deferred_translation_updates network option.
wp_set_deferred_translation_updates( array( array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' ) ) );
return array_values( wp_get_deferred_translation_updates() );
