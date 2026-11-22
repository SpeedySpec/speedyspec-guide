<?php
// Deprecated in 3.3.0; use Use WP_Screen::render_screen_meta(). Printed the screen's Help and Screen Options tabs, now through WP_Screen.
set_current_screen( 'dashboard' );
list( $result, $notice ) = guide_deprecated( 'screen_meta', 'dashboard' );
return str_contains( $notice, 'id="screen-meta"' );
