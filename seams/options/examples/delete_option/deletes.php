<?php
// Deletes a stored option and returns true; it then reads as missing.
return array( delete_option( 'blogdescription' ), get_option( 'blogdescription' ) );
