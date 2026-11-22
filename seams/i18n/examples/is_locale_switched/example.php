<?php
// Whether the locale is switched.
$before = is_locale_switched();
switch_to_locale( 'fr_FR' );
return array( $before, is_locale_switched() );
