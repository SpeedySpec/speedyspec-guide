<?php
// Checks an attribute value against a rule such as maxlen or valueless.
return array( wp_kses_check_attr_val( 'abc', 'n', 'maxlen', 2 ), wp_kses_check_attr_val( 'ab', 'n', 'maxlen', 2 ), wp_kses_check_attr_val( '', 'y', 'valueless', 'y' ) );
