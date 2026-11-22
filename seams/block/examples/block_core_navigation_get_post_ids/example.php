<?php
// The post IDs of the Navigation Link and Submenu blocks of kind post-type in blocks, at any depth.
$inner = new WP_Block_List( parse_blocks( '<!-- wp:navigation-link {"id":5,"kind":"post-type","label":"A"} /--><!-- wp:navigation-submenu {"id":6,"kind":"post-type","label":"B"} --><!-- wp:navigation-link {"id":7,"kind":"post-type","label":"C"} /--><!-- wp:navigation-link {"id":8,"kind":"taxonomy","label":"D"} /--><!-- /wp:navigation-submenu -->' ) );
return block_core_navigation_get_post_ids( $inner );
