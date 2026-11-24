<?php
// Hooked to wp_head: prints the generator meta tag through the_generator().
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', guide_render( 'wp_generator' ) );
