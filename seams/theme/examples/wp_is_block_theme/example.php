<?php
// Whether the active theme is a block theme: it has templates/index.html (or block-templates).
$classic = wp_is_block_theme();
switch_theme( 'twentytwentyfive' );
return array( $classic, wp_is_block_theme() );
