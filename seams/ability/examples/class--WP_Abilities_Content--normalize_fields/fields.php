<?php
// The requested field paths or the default set; whole fields include their sub-fields, and link, excerpt and content prime the meta and term caches.
guide_core_abilities();
$content = new WP_Abilities_Content();
return array(
	guide_private( $content, 'normalize_fields', array() ),
	guide_private( $content, 'get_field_paths' ),
	guide_private( $content, 'is_field_requested', 'title.rendered', array( 'title' ) ),
	guide_private( $content, 'should_prime_post_caches', array( 'content' ) ),
	guide_private( $content, 'should_prime_post_caches', array( 'title' ) ),
);
