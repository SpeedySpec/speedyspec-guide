<?php
// Each registered setting's arguments, keyed by option name.
register_setting( 'guide', 'guide_a' );
register_setting( 'guide', 'guide_b' );
return array_keys( get_registered_settings() );
