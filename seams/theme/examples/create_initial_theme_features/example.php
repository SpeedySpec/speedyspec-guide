<?php
// Hooked to setup_theme: registers WordPress's theme features (align-wide, custom-logo, editor-color-palette, html5, post-thumbnails and the rest) with their schemas.
create_initial_theme_features();
return array( get_registered_theme_feature( 'align-wide' )['type'], get_registered_theme_feature( 'editor-color-palette' )['type'] );
