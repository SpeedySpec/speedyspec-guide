<?php
// Prints the generator tag in a format; filtered by the_generator.
return guide_render( fn() => the_generator( 'xhtml' ) );
