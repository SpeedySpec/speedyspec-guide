<?php
// Registers a meta key for posts of a type (all types when empty), with its type, single flag, default, sanitizing, auth and REST settings.
register_post_meta( 'post', 'rating', array( 'type' => 'integer', 'single' => true, 'default' => 3, 'show_in_rest' => true ) );
$id = wp_insert_post( array( 'post_title' => 'R' ) );
return array( get_post_meta( $id, 'rating', true ), array_key_exists( 'rating', get_registered_meta_keys( 'post', 'post' ) ) );
