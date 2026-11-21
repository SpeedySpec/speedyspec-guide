<?php
// Tag names come back uppercased; closers are flagged.
$p = new WP_HTML_Tag_Processor( '<Div></div>' );
$p->next_tag( array( 'tag_closers' => 'visit' ) );
$open = array( $p->get_tag(), $p->is_tag_closer() );
$p->next_tag( array( 'tag_closers' => 'visit' ) );
return array( $open, array( $p->get_tag(), $p->is_tag_closer() ) );
