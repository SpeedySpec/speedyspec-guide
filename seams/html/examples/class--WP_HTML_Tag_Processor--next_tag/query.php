<?php
// A query can name the tag and a class; tag closers are skipped unless asked for.
$p = new WP_HTML_Tag_Processor( '<div><img class="a"><img class="b"></div>' );
$p->next_tag( array( 'tag_name' => 'img', 'class_name' => 'b' ) );
return $p->get_attribute( 'class' );
