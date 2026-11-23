<?php
// Deprecated in 3.3.0; use $current_screen->render_screen_layout(). Gave the Screen Options layout columns; now gives an empty string.
set_current_screen( 'dashboard' );
return guide_deprecated( 'screen_layout', 'dashboard' );
