<?php
// Prints the Quick Draft widget: the title and content form, and the user's recent drafts.
return str_contains( guide_render( fn() => wp_dashboard_quick_press() ), 'id="quick-press"' );
