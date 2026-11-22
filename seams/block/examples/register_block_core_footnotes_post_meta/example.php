<?php
// Hooked to init: registers the footnotes post meta, revisioned and shown in REST, for post types that support the editor and custom fields.
register_block_core_footnotes_post_meta();
$meta = get_registered_meta_keys( 'post', 'post' );
return array( isset( $meta['footnotes'] ), $meta['footnotes']['revisions_enabled'] ?? null );
