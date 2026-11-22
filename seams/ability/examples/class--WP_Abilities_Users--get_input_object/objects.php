<?php
// An object member of the input as an array, an empty array when missing, or null when it isn't an object.
guide_core_abilities();
$users = new WP_Abilities_Users();
return array( guide_private( $users, 'get_input_object', array( 'where' => (object) array( 'ids' => array( 1 ) ) ), 'where' ), guide_private( $users, 'get_input_object', array(), 'where' ), guide_private( $users, 'get_input_object', array( 'where' => 'x' ), 'where' ) );
