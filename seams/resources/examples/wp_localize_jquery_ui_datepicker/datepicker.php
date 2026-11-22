<?php
// Localizes the jQuery UI datepicker with the site's month and day names, date format and start of week, when it is queued.
wp_enqueue_script( 'jquery-ui-datepicker' );
wp_localize_jquery_ui_datepicker();
return str_contains( implode( '', (array) wp_scripts()->get_data( 'jquery-ui-datepicker', 'after' ) ), '"firstDay":1' );
