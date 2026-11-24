<?php
// Prints the generator tag in a format; filtered by the_generator.
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', guide_render( fn() => the_generator( 'xhtml' ) ) );
