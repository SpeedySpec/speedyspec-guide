<?php
// Whether a PHP setting can be changed with ini_set() at run time.
return array( wp_is_ini_value_changeable( 'memory_limit' ), wp_is_ini_value_changeable( 'max_execution_time' ), wp_is_ini_value_changeable( 'disable_functions' ) );
