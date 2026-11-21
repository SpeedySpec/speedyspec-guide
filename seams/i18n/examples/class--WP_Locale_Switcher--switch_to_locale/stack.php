<?php
// The switcher keeps a stack of switches: is_switched(), get_switched_locale() and get_switched_user_id() report the top; switching to the current locale, or one not installed, is refused.
$s = $GLOBALS['wp_locale_switcher'];
$results = array( $s->switch_to_locale( 'en_US' ), $s->switch_to_locale( 'fr_FR', 7 ), $s->is_switched(), $s->get_switched_locale(), $s->get_switched_user_id(), $s->filter_locale( 'en_US' ) );
$results[] = $s->restore_current_locale();
$results[] = $s->get_switched_locale();
return $results;
