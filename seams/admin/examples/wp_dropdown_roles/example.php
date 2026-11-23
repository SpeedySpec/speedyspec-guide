<?php
// Prints the options of a role select, the roles the user may give, with one selected.
return guide_render( fn() => wp_dropdown_roles( 'editor' ) );
