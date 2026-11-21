<?php
// Saves a new value, and returns true.
return array( update_option( 'blogname', 'Renamed' ), get_option( 'blogname' ) );
