<?php
// The merged theme.json settings (core, theme, user), or one path of them, for a block or origin; cached per theme.
guide_theme( 'twentytwentyfive' );
return array( wp_get_global_settings( array( 'layout', 'contentSize' ) ), count( wp_get_global_settings( array( 'color', 'palette', 'theme' ) ) ) > 0 );
