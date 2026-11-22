<?php
// The meta keys revisioned for a post type: those registered with revisions_enabled, filtered by wp_post_revision_meta_keys.
register_post_meta( 'post', 'guide_note', array( 'single' => true, 'type' => 'string', 'revisions_enabled' => true ) );
register_post_meta( 'post', 'guide_other', array( 'single' => true, 'type' => 'string' ) );
return array( in_array( 'guide_note', wp_post_revision_meta_keys( 'post' ), true ), in_array( 'guide_other', wp_post_revision_meta_keys( 'post' ), true ) );
