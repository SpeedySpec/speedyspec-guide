<?php
// Elements the HTML leaves open are closed where a browser would close them; the processor visits those closers too.
$p = WP_HTML_Processor::create_fragment( '<p>one<p>two' );
$tokens = array();
while ( $p->next_token() ) {
	$tokens[] = ( $p->is_tag_closer() ? '/' : '' ) . $p->get_token_name();
}
return $tokens;
