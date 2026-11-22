<?php
// data-wp-class adds or removes a class, and data-wp-bind sets an attribute, from the context.
$html = '<div data-wp-interactive="my-plugin" data-wp-context=\'{"open":true}\'><button data-wp-class--is-open="context.open" data-wp-bind--aria-expanded="context.open">Menu</button></div>';
$p = new WP_HTML_Tag_Processor( wp_interactivity_process_directives( $html ) );
$p->next_tag( 'button' );
return array( $p->get_attribute( 'class' ), $p->get_attribute( 'aria-expanded' ) );
