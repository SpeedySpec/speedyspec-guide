<?php
// Loads the theme's footer.php (or footer-{name}.php), falling back to the bundled compatibility footer; fires get_footer.
$html = guide_render( 'get_footer' );
return array( did_action( 'get_footer' ), str_contains( $html, '</html>' ) );
