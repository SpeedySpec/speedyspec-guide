<?php
// The contact methods on the profile screen: none by default; user_contactmethods filters them.
add_filter( 'user_contactmethods', fn( $methods ) => $methods + array( 'mastodon' => 'Mastodon' ) );
return array( wp_get_user_contact_methods(), _wp_get_user_contactmethods() );
