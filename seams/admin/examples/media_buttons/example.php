<?php
// Prints the Add Media button above the classic editor and fires media_buttons for more.
return str_contains( guide_render( fn() => media_buttons() ), 'insert-media' );
