<?php
// Whether the main query is for search results.
guide_go( '/?s=hello' );
return array( is_search(), get_search_query() );
