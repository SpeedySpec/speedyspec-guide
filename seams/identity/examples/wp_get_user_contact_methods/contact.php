<?php
// The contact methods on the profile screen: none by default; user_contactmethods filters them.
function guide_add_mastodon_contact( $methods ) {
	return $methods + array( 'mastodon' => 'Mastodon' );
}
add_filter( 'user_contactmethods', 'guide_add_mastodon_contact' );
return array( wp_get_user_contact_methods(), _wp_get_user_contactmethods() );
