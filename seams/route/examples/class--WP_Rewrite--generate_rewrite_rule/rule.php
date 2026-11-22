<?php
// Rules for one structure without endpoints, feeds or pages: a tag becomes its regex and query var; an unknown tag is left as it is.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
add_rewrite_tag( '%guide%', '([^/]+)' );
return array( $r->generate_rewrite_rule( '/guides/%guide%/' ), $r->generate_rewrite_rule( '/guides/%unknown%/' ) );
