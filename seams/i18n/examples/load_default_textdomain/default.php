<?php
// Loads WordPress's own translations for the locale from WP_LANG_DIR (and the admin's in the admin); English loads nothing.
$english = load_default_textdomain();
unload_textdomain( 'default' );
$french = load_default_textdomain( 'fr_FR' );
return array( $english, $french, translate( 'Hello' ) );
