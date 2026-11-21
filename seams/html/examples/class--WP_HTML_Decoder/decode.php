<?php
// Decodes character references as HTML does, which differs between text and attribute values.
return array( WP_HTML_Decoder::decode_text_node( '&lt;b&gt; &amp;copy &notit;' ), WP_HTML_Decoder::decode_attribute( '&notit;' ) );
