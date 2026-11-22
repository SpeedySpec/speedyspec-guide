<?php
// Prints a random line of the song in a <p id="dolly"> in the admin notices, marked as English when the user's locale isn't.
guide_hello_dolly();
mt_srand( 3 );
return array( guide_render( 'hello_dolly' ), has_action( 'admin_notices', 'hello_dolly' ) );
