<?php
switch_to_locale( 'fr_FR' );
// Registers the child theme's folder, or a given path, for a text domain.
return load_child_theme_textdomain( 'guide-child', WP_LANG_DIR . '/themes' );
