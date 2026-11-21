<?php
switch_to_locale( 'fr_FR' );
// Goes back to the locale before the last switch, or false when not switched.
return array( restore_previous_locale(), restore_previous_locale() );
