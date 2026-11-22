<?php
// The meta field of a REST object: meta registered with show_in_rest, read and written through the object's meta property with each key's schema; the post, term, comment and user subclasses name the meta type.
register_post_meta( 'post', 'guide_mood', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
register_post_meta( 'post', 'guide_hidden', array( 'type' => 'string', 'single' => true ) );
$id = wp_insert_post( array( 'post_title' => 'Moody', 'post_status' => 'publish' ) );
guide_rest( 'POST', "/wp/v2/posts/$id", array( 'meta' => array( 'guide_mood' => 'calm' ) ) );
update_post_meta( $id, 'guide_hidden', 'x' );
$fields = new WP_REST_Post_Meta_Fields( 'post' );
return array( get_post_meta( $id, 'guide_mood', true ), $fields->get_value( $id, new WP_REST_Request() ), ( fn() => array( $this->get_meta_type(), $this->get_rest_field_type() ) )->call( $fields ) );
