<?php
// Says whether the current element's breadcrumbs end with the ones given.
$p = WP_HTML_Processor::create_fragment( '<ul><li><a href="#">x</a></li></ul>' );
$p->next_tag( 'A' );
return array( $p->matches_breadcrumbs( array( 'LI', 'A' ) ), $p->matches_breadcrumbs( array( 'UL', '*', 'A' ) ), $p->matches_breadcrumbs( array( 'UL', 'A' ) ) );
