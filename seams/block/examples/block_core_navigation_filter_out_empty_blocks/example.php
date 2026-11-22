<?php
// Blocks without the empty whitespace blocks parse_blocks() leaves between them.
$blocks = parse_blocks( "<!-- wp:navigation-link {\"label\":\"Home\"} /-->\n\n<!-- wp:navigation-link {\"label\":\"About\"} /-->" );
return array( count( $blocks ), count( block_core_navigation_filter_out_empty_blocks( $blocks ) ) );
