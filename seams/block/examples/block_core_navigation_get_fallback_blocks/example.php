<?php
// The blocks a Navigation block shows when it has no menu: the newest navigation post, a classic menu, or a page list.
wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'Header', 'post_status' => 'publish', 'post_content' => '<!-- wp:navigation-link {"label":"Docs","url":"https://example.org/docs"} /-->' ) );
return wp_list_pluck( block_core_navigation_get_fallback_blocks(), 'blockName' );
