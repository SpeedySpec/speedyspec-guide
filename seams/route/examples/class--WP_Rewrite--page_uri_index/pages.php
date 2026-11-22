<?php
// page_rewrite_rules(): the page structure's rules, which match any path as a page name. (page_uri_index(), which reads the pages from the database, isn't run here.)
$r = guide_permalinks( '/%postname%/' );
add_filter( 'page_rewrite_rules', fn( $rules ) => $rules );
return array_keys( $r->page_rewrite_rules() );
