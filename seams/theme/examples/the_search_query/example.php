<?php
// Prints the search terms, escaped for an attribute; filtered by the_search_query.
guide_go( '/?s=apples' );
return guide_render( 'the_search_query' );
