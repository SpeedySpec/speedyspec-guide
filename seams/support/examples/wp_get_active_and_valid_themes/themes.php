<?php
// The active theme's folders, the child before the parent, when they are not being installed and not paused.
return array_map( 'basename', wp_get_active_and_valid_themes() );
