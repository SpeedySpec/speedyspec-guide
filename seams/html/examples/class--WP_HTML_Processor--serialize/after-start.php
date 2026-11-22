<?php
// serialize() works only on a processor that hasn't started; otherwise it warns and gives null.
$p = WP_HTML_Processor::create_fragment( '<p>x' );
$fresh = $p->serialize();
$q = WP_HTML_Processor::create_fragment( '<p>x' );
$q->next_tag();
return array( $fresh, @$q->serialize() );
