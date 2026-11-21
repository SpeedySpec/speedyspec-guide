<?php
// Finds tags in HTML and changes their attributes, without building a tree.
$p = new WP_HTML_Tag_Processor( '<p>One</p><p class="two">Two</p>' );
while ( $p->next_tag( 'p' ) ) {
	$p->add_class( 'note' );
}
return $p->get_updated_html();
