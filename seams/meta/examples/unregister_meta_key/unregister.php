<?php
// Removes a registered meta key and its sanitize and auth callbacks; false when it isn't registered.
register_meta( 'post', 'mood', array( 'sanitize_callback' => 'trim' ) );
$done = unregister_meta_key( 'post', 'mood' );
return array( $done, registered_meta_key_exists( 'post', 'mood' ), has_filter( 'sanitize_post_meta_mood' ), unregister_meta_key( 'post', 'mood' ) );
