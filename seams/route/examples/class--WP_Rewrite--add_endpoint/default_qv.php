<?php
// An endpoint with query var false adds no query var; endpoints add their rules to the structures in their mask.
$r = guide_permalinks( '/%postname%/' );
$r->add_endpoint( 'print', EP_PERMALINK, false );
return array( $r->endpoints, preg_grep( '/print/', array_keys( $r->generate_rewrite_rules( $r->permalink_structure, EP_PERMALINK ) ) ) );
