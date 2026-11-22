<?php
// Prints a link to edit a term, for users who can; filtered by edit_term_link.
return guide_render( fn() => edit_term_link( 'Edit', '<p>', '</p>', get_term( 1 ) ) );
