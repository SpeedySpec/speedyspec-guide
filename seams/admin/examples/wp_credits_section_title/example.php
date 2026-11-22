<?php
// Prints a credits group's title, if it has one.
return guide_render( fn() => wp_credits_section_title( array( 'name' => 'Noteworthy Contributors' ) ) );
