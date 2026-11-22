<?php
// The post rules from /%year%/%monthnum%/%postname%/: the post, its pages, feeds, trackback, embed, comment pages and attachments.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
return array_keys( $r->generate_rewrite_rules( $r->permalink_structure, EP_PERMALINK ) );
