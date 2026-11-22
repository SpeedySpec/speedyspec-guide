<?php
// Removes a registered post type that isn't built in, with its supports, rewrite and hooks; fires unregistered_post_type.
register_post_type( 'book' );
$removed = unregister_post_type( 'book' );
return array( $removed, post_type_exists( 'book' ), unregister_post_type( 'post' )->get_error_code() );
