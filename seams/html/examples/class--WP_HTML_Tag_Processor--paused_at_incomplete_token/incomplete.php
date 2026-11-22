<?php
// HTML that ends inside a tag leaves the processor paused at the incomplete token.
$p = new WP_HTML_Tag_Processor( '<p>text<img src="x' );
while ( $p->next_tag() ) {
}
return $p->paused_at_incomplete_token();
