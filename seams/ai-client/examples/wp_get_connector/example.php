<?php
// A registered connector's data by ID, or null.
$akismet = wp_get_connector( 'akismet' );
return array( $akismet['name'], $akismet['type'], $akismet['authentication']['method'], wp_get_connector( 'nonesuch' ) );
