<?php
// Sets an attribute, escaping its value: URL attributes such as href go through esc_url(), others have < > & " ' escaped. true writes a boolean attribute.
$p = new WP_HTML_Tag_Processor( '<a>link</a>' );
$p->next_tag();
$p->set_attribute( 'href', 'https://example.org/?a=1&b=2' );
$p->set_attribute( 'title', 'Tom & "Jerry"' );
$p->set_attribute( 'download', true );
return $p->get_updated_html();
