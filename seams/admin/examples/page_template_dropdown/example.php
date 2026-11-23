<?php
// Prints the options of the page templates select, from the theme's templates for a post type.
switch_theme( 'twentytwenty' );
return guide_render( fn() => page_template_dropdown( '', 'page' ) );
