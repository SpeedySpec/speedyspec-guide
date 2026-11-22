<?php
// A setting is an option: get_option() falls back to its default until update_option() saves a value.
$before = get_option( 'my_first_plugin_greeting', 'Hello!' );
update_option( 'my_first_plugin_greeting', 'Howdy, partner!' );
return array( $before, get_option( 'my_first_plugin_greeting', 'Hello!' ) );
