<?php
// Parses a whole document, adding the elements a browser would imply.
$p = WP_HTML_Processor::create_full_parser( '<title>T</title><p>Hi' );
$p->next_tag( 'P' );
return $p->get_breadcrumbs();
