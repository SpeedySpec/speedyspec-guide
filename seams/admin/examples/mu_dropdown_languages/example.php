<?php
// Prints the options of a network's language select, from the installed language files, with one selected.
return guide_render( fn() => mu_dropdown_languages( array( 'fr_FR.mo' ), 'fr_FR' ) );
