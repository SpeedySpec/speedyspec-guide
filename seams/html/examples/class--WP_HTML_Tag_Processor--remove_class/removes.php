<?php
// Removes a class, and the class attribute once it is empty.
$p = new WP_HTML_Tag_Processor( '<p class="a b">' );
$p->next_tag();
$p->remove_class( 'a' );
$after_one = $p->get_updated_html();
$p->remove_class( 'b' );
return array( $after_one, $p->get_updated_html() );
