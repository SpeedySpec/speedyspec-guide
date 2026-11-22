<?php
// A structure's defaults: with_front, the endpoint mask, paged, feed, forcomments, walk_dirs and endpoints; a leading slash is added, and the front when with_front.
$r = guide_permalinks( '/blog/%postname%/' );
$r->add_permastruct( 'guide', 'guides/%guide%' );
return $r->extra_permastructs['guide'];
