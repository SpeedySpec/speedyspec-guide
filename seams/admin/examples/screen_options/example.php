<?php
// Deprecated in 3.3.0; use $current_screen->render_per_page_options(). Gave the Screen Options per-page field; now gives an empty string.
set_current_screen( 'dashboard' );
return guide_deprecated( 'screen_options', 'dashboard' );
