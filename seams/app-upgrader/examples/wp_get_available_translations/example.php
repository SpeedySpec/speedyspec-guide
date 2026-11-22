<?php
// The core translations available for this WordPress version, by locale, from the Translations API, cached for three hours.
guide_queue_http( array( array( 'translations' => array( array( 'language' => 'fr_FR', 'version' => '7.2', 'updated' => '2026-11-01', 'english_name' => 'French (France)', 'native_name' => 'Français', 'package' => 'https://downloads.wordpress.org/translation/core/7.2/fr_FR.zip', 'iso' => array( 'fr' ), 'strings' => array( 'continue' => 'Continuer' ) ) ) ) ) );
$translations = wp_get_available_translations();
return array( array_keys( $translations ), $translations['fr_FR']['native_name'] );
