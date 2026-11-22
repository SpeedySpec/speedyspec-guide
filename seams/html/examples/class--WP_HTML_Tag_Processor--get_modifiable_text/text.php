<?php
// The decoded text of a text node, or the contents of an element such as TEXTAREA.
$p = new WP_HTML_Tag_Processor( '<p>A &amp; B</p><textarea>x &lt; y</textarea>' );
$p->next_token();
$p->next_token();
$text = $p->get_modifiable_text();
$p->next_tag( 'textarea' );
return array( $text, $p->get_modifiable_text() );
