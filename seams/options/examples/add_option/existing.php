<?php
// An option that is already stored is not replaced.
return array( add_option( 'blogname', 'Other' ), get_option( 'blogname' ) );
