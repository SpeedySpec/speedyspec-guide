<?php
// Prints the messages recorded for a setting, or for all, as admin notices.
add_settings_error( 'tea_blend', 'saved', 'Saved.', 'success' );
return guide_render( 'settings_errors' );
