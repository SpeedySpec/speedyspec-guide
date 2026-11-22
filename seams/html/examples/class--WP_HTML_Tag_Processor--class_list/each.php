<?php
// Each class once, in order.
$p = new WP_HTML_Tag_Processor( '<p class="a  b a">' );
$p->next_tag();
return iterator_to_array( $p->class_list(), false );
