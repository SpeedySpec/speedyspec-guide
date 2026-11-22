<?php
// The search terms of the current search, escaped unless asked not to; filtered by get_search_query.
guide_go( '/?s=' . rawurlencode( '<b>red</b> apples' ) );
return array( get_search_query(), get_search_query( false ) );
