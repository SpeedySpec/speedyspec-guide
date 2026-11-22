<?php
// A bookmark marks a tag to come back to with seek().
$p = new WP_HTML_Tag_Processor( '<ul><li>a</li><li>b</li></ul>' );
$p->next_tag( 'li' );
$p->set_bookmark( 'first' );
$p->next_tag( 'li' );
$p->seek( 'first' );
$p->set_attribute( 'class', 'first' );
return $p->get_updated_html();
