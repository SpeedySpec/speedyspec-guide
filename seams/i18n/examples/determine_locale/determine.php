<?php
// The locale for the request: the site's, the user's in the admin, the requested one on wp-login.php or the installer; pre_determine_locale can answer first, skipping the determine_locale filter, which otherwise filters the result.
$plain = determine_locale();
function guide_pre_determine_locale( $locale ) {
	return 'es_ES';
}
add_filter( 'pre_determine_locale', 'guide_pre_determine_locale' );
$pre = determine_locale();
remove_all_filters( 'pre_determine_locale' );
function guide_mark_locale( $locale ) {
	return $locale . '!';
}
add_filter( 'determine_locale', 'guide_mark_locale' );
return array( $plain, $pre, determine_locale() );
