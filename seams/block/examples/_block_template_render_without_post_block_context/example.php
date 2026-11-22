<?php
// Hooked to render_block_context: drops the post from a block's context when rendering a template itself, so Post Content doesn't recurse.
return _block_template_render_without_post_block_context( array( 'postId' => 7, 'postType' => 'wp_template', 'other' => 1 ) );
