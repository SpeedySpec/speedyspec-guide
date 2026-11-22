<?php
// The filters and actions set_site_transient() fires, in order.
function guide_announce_pre_set_site_transient( $value ) {
	echo 'pre_set_site_transient_guide_t ';
	return $value;
}
add_filter( 'pre_set_site_transient_guide_t', 'guide_announce_pre_set_site_transient' );
function guide_announce_expiration_of_site_transient( $expiration ) {
	echo 'expiration_of_site_transient_guide_t ';
	return $expiration;
}
add_filter( 'expiration_of_site_transient_guide_t', 'guide_announce_expiration_of_site_transient' );
function guide_announce_set_site_transient_guide_t() {
	echo 'set_site_transient_guide_t ';
}
add_action( 'set_site_transient_guide_t', 'guide_announce_set_site_transient_guide_t' );
function guide_announce_set_site_transient() {
	echo 'set_site_transient ';
}
add_action( 'set_site_transient', 'guide_announce_set_site_transient' );
return set_site_transient( 'guide_t', 'v', 60 );
