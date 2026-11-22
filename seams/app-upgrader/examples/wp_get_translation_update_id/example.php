<?php
// The ID of a translation update: an MD5 of its type, slug, language and version.
return wp_get_translation_update_id( array( 'type' => 'plugin', 'slug' => 'akismet', 'language' => 'fr_FR', 'version' => '5.0' ) ) === md5( '{"type":"plugin","slug":"akismet","language":"fr_FR","version":"5.0"}' );
