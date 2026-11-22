<?php
// In the post editor, preloads the fields route for the edited post's type. ($wp_post_types is set here as register_post_type() would.)
$GLOBALS['wp_post_types']['book'] = (object) array( 'name' => 'book' );
$context = new WP_Block_Editor_Context( array( 'name' => 'core/edit-post', 'post' => (object) array( 'post_type' => 'book' ) ) );
return _wp_preload_entity_fields( array(), $context );
