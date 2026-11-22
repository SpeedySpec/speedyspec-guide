<?php
// WP_Theme_JSON_Schema migrates theme.json from older versions to the latest: version 1's custom-prefixed settings such as customPadding renamed, version 2's defaults for font sizes and spacing kept.
$migrated = WP_Theme_JSON_Schema::migrate( array( 'version' => 1, 'settings' => array( 'color' => array( 'customGradient' => true ), 'spacing' => array( 'customPadding' => true ) ) ) );
return array( $migrated['version'], $migrated['settings'] );
