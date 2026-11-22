<?php
// Adds #content to the links of a paged post's later pages; on wp_link_pages_link.
guide_theme( 'twentynineteen' );
return array( twentynineteen_link_pages_link( '<a href="http://example.org/?p=1&page=2">2</a>', 2 ), twentynineteen_link_pages_link( '<a href="http://example.org/?p=1">1</a>', 1 ) );
