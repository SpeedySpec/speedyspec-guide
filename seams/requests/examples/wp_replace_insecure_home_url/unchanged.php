<?php
// When the site doesn't need it, content is returned as it is.
function guide_no_https_migration( $pre ) {
	return '';
}
add_filter( 'pre_option_https_migration_required', 'guide_no_https_migration' );
return wp_replace_insecure_home_url( 'http://example.org/a' );
