<?php
// pre_load_textdomain can answer first, override_load_textdomain can take over entirely.
function guide_block_textdomain( $pre, $domain ) {
	return 'blocked' === $domain ? false : $pre;
}
add_filter( 'pre_load_textdomain', 'guide_block_textdomain', 10, 2 );
function guide_take_over_textdomain( $override, $domain ) {
	return 'taken' === $domain ? true : $override;
}
add_filter( 'override_load_textdomain', 'guide_take_over_textdomain', 10, 2 );
return array( load_textdomain( 'blocked', WP_LANG_DIR . '/fr_FR.mo' ), load_textdomain( 'taken', '/nowhere.mo' ), is_textdomain_loaded( 'taken' ) );
