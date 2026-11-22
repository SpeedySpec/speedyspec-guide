<?php
// The admin's view transition CSS: cross-document navigation, with the admin menu named so it stays still.
return str_contains( wp_get_view_transitions_admin_css(), '@view-transition' );
