<?php
// __() translates; esc_attr__() and esc_html__() also escape; _x() and its escaping forms take a context.
switch_to_locale( 'fr_FR' );
return array( __( 'Hello' ), __( 'Hello', 'missing' ), esc_attr__( 'A "q"' ), esc_html__( '<b>' ), _x( 'Post', 'verb' ), esc_attr_x( 'Post', 'verb' ), esc_html_x( '<i>', 'tag' ) );
