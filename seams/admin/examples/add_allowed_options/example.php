<?php
// Adds options to the options each settings group may save, through options.php.
$allowed = add_allowed_options( array( 'tea' => array( 'tea_blend' ) ), array( 'general' => array( 'blogname' ) ) );
return $allowed;
