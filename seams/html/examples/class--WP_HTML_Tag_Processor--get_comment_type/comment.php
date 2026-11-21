<?php
// Comments, and markup HTML treats as comments, report what kind they are; a PHP-style tag is a processing instruction, not a comment.
$p = new WP_HTML_Tag_Processor( '<!-- a --><![CDATA[x]]><?php x ?>' );
$types = array();
while ( $p->next_token() ) {
	$types[] = array( $p->get_token_type(), $p->get_comment_type() );
}
return $types;
