<?php
// Removes the backslashes preg_replace() adds before double quotes.
return wp_kses_stripslashes( 'say \\"hi\\"' );
