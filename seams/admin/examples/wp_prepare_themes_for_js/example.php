<?php
// The installed themes' data for the themes screen's script: names, screenshots, versions, actions, update notices and auto-update state.
$themes = wp_prepare_themes_for_js( array( wp_get_theme( 'twentytwentyfive' ) ) );
$theme = reset( $themes );
return array( $theme['id'], $theme['name'], isset( $theme['actions']['activate'] ) );
