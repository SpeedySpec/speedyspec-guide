<?php
// Returns whether the value changed: the second call finds it already off.
return array( wp_set_option_autoload( 'blogname', 'off' ), wp_set_option_autoload( 'blogname', 'off' ) );
