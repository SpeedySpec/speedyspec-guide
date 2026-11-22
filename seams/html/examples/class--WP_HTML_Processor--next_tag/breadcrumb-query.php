<?php
// A query can match by breadcrumbs: here, an IMG directly inside a FIGURE; * matches any element.
$p = WP_HTML_Processor::create_fragment( '<img src="a"><figure><img src="b"></figure>' );
$p->next_tag( array( 'breadcrumbs' => array( 'FIGURE', 'IMG' ) ) );
return $p->get_attribute( 'src' );
