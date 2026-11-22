<?php
// A Navigation block's submenu visibility setting, reading the deprecated openSubmenusOnClick attribute too.
return array( block_core_navigation_get_submenu_visibility( array( 'openSubmenusOnClick' => true ) ), block_core_navigation_get_submenu_visibility( array() ) );
