<?php
// A tag processor that can replace what is between a tag and its closer.
$p = new WP_Interactivity_API_Directives_Processor( '<div><p>old <i>text</i></p></div>' );
$p->next_tag( 'p' );
$p->set_content_between_balanced_tags( 'new <text>' );
return $p->get_updated_html();
