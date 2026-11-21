<?php
// Reads several options at once; a missing one is false.
return get_options( array( 'blogname', 'guide_missing' ) );
