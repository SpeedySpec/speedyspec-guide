<?php
// Prints the script that marks the body or html as supporting the Customizer, for showing its links.
return str_contains( guide_render( 'wp_customize_support_script' ), 'customize-support' );
