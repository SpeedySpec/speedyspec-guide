<?php
// The names of the tag's attributes that start with a prefix, lowercased.
$p = new WP_HTML_Tag_Processor( '<div data-a="1" DATA-B="2" id="x">' );
$p->next_tag();
return $p->get_attribute_names_with_prefix( 'data-' );
