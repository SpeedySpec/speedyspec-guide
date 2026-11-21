<?php
// pre_load_textdomain can answer first, override_load_textdomain can take over entirely.
add_filter( 'pre_load_textdomain', fn( $pre, $domain ) => 'blocked' === $domain ? false : $pre, 10, 2 );
add_filter( 'override_load_textdomain', fn( $o, $domain ) => 'taken' === $domain ? true : $o, 10, 2 );
return array( load_textdomain( 'blocked', WP_LANG_DIR . '/fr_FR.mo' ), load_textdomain( 'taken', '/nowhere.mo' ), is_textdomain_loaded( 'taken' ) );
