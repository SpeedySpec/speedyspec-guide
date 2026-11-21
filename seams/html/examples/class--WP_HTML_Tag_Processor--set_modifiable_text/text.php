<?php
// Replaces a text node's text, escaping it.
$p = new WP_HTML_Tag_Processor( '<p>old</p>' );
$p->next_token();
$p->next_token();
$p->set_modifiable_text( 'new <b>' );
return $p->get_updated_html();
