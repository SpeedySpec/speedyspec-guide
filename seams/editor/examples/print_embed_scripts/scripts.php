<?php
// Prints the embed template's script inline, from the built wp-includes/js/wp-embed-template.js; here, a source checkout without built scripts, the script is empty.
return substr( guide_render( 'print_embed_scripts' ), 0, 60 );
