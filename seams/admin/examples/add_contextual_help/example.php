<?php
// Deprecated in 3.3.0; use get_current_screen()->add_help_tab(). Added help text to a screen's Help tab.
set_current_screen( 'dashboard' );
return guide_deprecated( 'add_contextual_help', 'dashboard', 'Some help' );
