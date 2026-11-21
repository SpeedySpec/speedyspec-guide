<?php
// How many elements are open at the current token, HTML and BODY included.
$p = WP_HTML_Processor::create_fragment( '<div><span>x</span></div>' );
$p->next_tag( 'SPAN' );
return $p->get_current_depth();
