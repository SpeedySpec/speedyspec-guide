<?php
// Prints the search terms of the admin screen's request, escaped for an input's value.
$_REQUEST['s'] = 'green "tea"';
return guide_render( '_admin_search_query' );
