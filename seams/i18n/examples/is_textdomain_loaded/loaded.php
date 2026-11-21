<?php
// Whether a text domain has translations loaded, not just NOOP ones; switching locale loads the default text domain.
switch_to_locale( 'fr_FR' );
$before = is_textdomain_loaded( 'default' );
__( 'Hello' );
return array( $before, is_textdomain_loaded( 'default' ), is_textdomain_loaded( 'nothing' ) );
