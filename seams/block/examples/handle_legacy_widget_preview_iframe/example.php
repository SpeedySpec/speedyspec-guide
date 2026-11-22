<?php
// Hooked to admin_init: renders a legacy widget's preview page when legacy-widget-preview is in the request, and stops.
unset( $_GET['legacy-widget-preview'] );
return handle_legacy_widget_preview_iframe();
