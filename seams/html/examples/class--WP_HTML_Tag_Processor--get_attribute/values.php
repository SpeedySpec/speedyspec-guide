<?php
// An attribute's value, decoded; true for a boolean attribute; null when it isn't there.
$p = new WP_HTML_Tag_Processor( '<input title="Tom &amp; Jerry" disabled>' );
$p->next_tag();
return array( $p->get_attribute( 'title' ), $p->get_attribute( 'disabled' ), $p->get_attribute( 'missing' ) );
