<?php
// Parses HTML as a browser builds its tree, so it knows each element's ancestors.
$p = WP_HTML_Processor::create_fragment( '<div><p>One <em>two</em></p></div>' );
$p->next_tag( 'EM' );
return $p->get_breadcrumbs();
