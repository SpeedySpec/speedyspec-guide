<?php
// The author, search, page, feed and comment feed structures. The category and tag structures are the taxonomies' extra structures, false until the taxonomies are registered, as here.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
return array( $r->get_category_permastruct(), $r->get_tag_permastruct(), $r->get_author_permastruct(), $r->get_search_permastruct(), $r->get_page_permastruct(), $r->get_feed_permastruct(), $r->get_comment_feed_permastruct(), $r->get_extra_permastruct( 'nope' ) );
