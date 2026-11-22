<?php
// Enqueues wp-embed when HTML holds a WordPress embed and wp_oembed_add_host_js is hooked to wp_head.
// wp-embed is one of WordPress's default scripts; it is registered here as wp_default_scripts() would.
wp_register_script( 'wp-embed', false );
add_action( 'wp_head', 'wp_oembed_add_host_js' );
wp_maybe_enqueue_oembed_host_js( '<p>No embed</p>' );
$before = wp_script_is( 'wp-embed', 'enqueued' );
wp_maybe_enqueue_oembed_host_js( '<blockquote class="wp-embedded-content">x</blockquote>' );
return array( $before, wp_script_is( 'wp-embed', 'enqueued' ) );
