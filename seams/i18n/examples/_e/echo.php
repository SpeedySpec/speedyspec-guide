<?php
// _e(), esc_attr_e() and esc_html_e() print the translation; _ex() with a context.
switch_to_locale( 'fr_FR' );
_e( 'Hello' );
echo "\n";
esc_attr_e( 'A "q"' );
echo "\n";
esc_html_e( '<b>' );
echo "\n";
_ex( 'Post', 'verb' );
return null;
