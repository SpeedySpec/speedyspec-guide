<?php
// Asks the WordPress.org Translations API for the translations of core, a plugin or a theme; translations_api and translations_api_result filter it.
guide_queue_http( array( array( 'translations' => array( array( 'language' => 'fr_FR', 'version' => '7.2', 'english_name' => 'French (France)', 'native_name' => 'Français', 'package' => 'https://downloads.wordpress.org/translation/core/7.2/fr_FR.zip', 'iso' => array( 'fr' ), 'strings' => array( 'continue' => 'Continuer' ) ) ) ) ) );
$api = translations_api( 'core', array( 'version' => '7.2' ) );
return wp_list_pluck( $api['translations'], 'language' );
