<?php
// Says whether the tag has a class; null when not on a tag.
$p = new WP_HTML_Tag_Processor( '<p class="a b">' );
$before = $p->has_class( 'a' );
$p->next_tag();
return array( $before, $p->has_class( 'b' ), $p->has_class( 'c' ) );
