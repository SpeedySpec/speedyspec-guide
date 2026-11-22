<?php
// Translation updates keyed by their ID.
$update = array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' );
$by_id = wp_get_translation_updates_by_id( array( $update ) );
return array_keys( $by_id ) === array( wp_get_translation_update_id( $update ) );
