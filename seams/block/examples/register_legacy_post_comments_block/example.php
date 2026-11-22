<?php
// Hooked to init: registers the old core/post-comments block for sites that used it, rendered by the Comments block.
if ( WP_Block_Type_Registry::get_instance()->is_registered( 'core/post-comments' ) ) {
	unregister_block_type( 'core/post-comments' );
}
register_legacy_post_comments_block();
return WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-comments' )->render_callback;
