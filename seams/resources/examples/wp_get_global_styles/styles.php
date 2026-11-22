<?php
// The merged theme.json styles, or one path of them, for a block, with preset references kept or turned into CSS variables as asked.
guide_theme( 'twentytwentyfive' );
return array( wp_get_global_styles( array( 'color', 'background' ) ), wp_get_global_styles( array( 'color', 'background' ), array( 'transforms' => array( 'resolve-variables' ) ) ) );
