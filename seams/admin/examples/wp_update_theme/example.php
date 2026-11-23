<?php
// Deprecated in 3.7.0; use new Theme_Upgrader();. Started a theme update, now with Theme_Upgrader.
$result = wp_update_theme( 'twentytwentyfive' );
return is_wp_error( $result ) ? $result->get_error_code() : $result;
