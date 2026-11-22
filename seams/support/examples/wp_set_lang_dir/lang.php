<?php
// Defines WP_LANG_DIR and LANGDIR: wp-content/languages when it exists, else wp-includes/languages.
wp_set_lang_dir();
return str_replace( ABSPATH, '', WP_LANG_DIR );
