<?php
// Visits every token: tags, closers, text, comments.
$p = new WP_HTML_Tag_Processor( '<p>Hi<!-- c --></p>' );
$types = array();
while ( $p->next_token() ) {
	$types[] = $p->get_token_type() . ( $p->is_tag_closer() ? '/' : '' );
}
return $types;
