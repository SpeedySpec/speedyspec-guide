<?php
// Removes an attribute, every copy of it.
$p = new WP_HTML_Tag_Processor( '<div id="a" id="b" class="x">' );
$p->next_tag();
$p->remove_attribute( 'id' );
return $p->get_updated_html();
