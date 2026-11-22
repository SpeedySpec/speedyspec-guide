<?php
// Whether a translation update is among those put off to install later.
$update = array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' );
wp_set_deferred_translation_updates( array( $update ) );
return array( wp_is_translation_update_deferred( $update ), wp_is_translation_update_deferred( array( 'type' => 'core', 'language' => 'de_DE' ) ) );
