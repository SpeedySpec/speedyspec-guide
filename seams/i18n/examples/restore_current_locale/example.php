<?php
switch_to_locale( 'fr_FR' );
switch_to_locale( 'en_US' );
// Undoes every switch, returning the original locale.
return array( restore_current_locale(), is_locale_switched(), restore_current_locale() );
