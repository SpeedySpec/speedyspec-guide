<?php
// Whether the current element will have a closer: void elements, raw-text ones and text don't.
$p = WP_HTML_Processor::create_fragment( '<div><br><textarea>x</textarea></div>' );
$out = array();
while ( $p->next_tag() ) {
	$out[ $p->get_tag() ] = $p->expects_closer();
}
return $out;
