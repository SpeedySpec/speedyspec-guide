<?php
// Reads the permalink structure and bases, and decides index permalinks, the front (the part before the first tag) and verbose page rules.
$r = guide_permalinks( '/blog/%postname%/' );
$pretty = array( $r->permalink_structure, $r->front, $r->root, $r->use_verbose_page_rules, $r->using_permalinks(), $r->using_index_permalinks(), $r->using_mod_rewrite_permalinks() );
$r = guide_permalinks( '/index.php/%year%/%postname%/' );
return array( $pretty, array( $r->front, $r->root, $r->using_index_permalinks(), $r->using_mod_rewrite_permalinks(), $r->use_verbose_page_rules ) );
