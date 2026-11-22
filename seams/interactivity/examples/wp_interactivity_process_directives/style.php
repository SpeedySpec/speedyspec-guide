<?php
// data-wp-style sets one style property, keeping the others.
wp_interactivity_state( 'my-plugin', array( 'color' => 'red' ) );
$p = new WP_HTML_Tag_Processor( wp_interactivity_process_directives( '<p data-wp-interactive="my-plugin" style="margin:0;color:blue" data-wp-style--color="state.color">x</p>' ) );
$p->next_tag();
return $p->get_attribute( 'style' );
