<?php
// Removes options from the options each settings group may save.
return remove_allowed_options( array( 'general' => array( 'blogname' ) ), array( 'general' => array( 'blogname', 'blogdescription' ) ) );
