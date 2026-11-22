<?php
// Hooked to wp_head: prints the robots meta tag from the directives the wp_robots filter gathers (noindex, follow, max-image-preview and others).
return guide_render( 'wp_robots' );
