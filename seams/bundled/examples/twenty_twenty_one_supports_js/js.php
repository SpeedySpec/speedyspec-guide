<?php
// Prints the script that removes no-js from the body; on wp_footer.
guide_theme( 'twentytwentyone' );
return str_contains( guide_render( 'twenty_twenty_one_supports_js' ), "document.body.classList.remove('no-js')" );
