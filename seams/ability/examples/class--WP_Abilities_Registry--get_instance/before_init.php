<?php
// Before init it refuses to start, with a notice; the functions then do nothing.
$GLOBALS['wp_actions'] = array();
return array( WP_Abilities_Registry::get_instance(), wp_has_ability( 'guide/add' ) );
