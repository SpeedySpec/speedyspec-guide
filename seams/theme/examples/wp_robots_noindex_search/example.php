<?php
// Hooked to wp_robots: adds noindex on search results.
guide_go( '/?s=apples' );
return wp_robots_noindex_search( array() );
