<?php
// Ajax handler for the General Settings screen: prints today's date in the date format typed, as a preview.
return guide_ajax( 'wp_ajax_date_format', array( 'date' => 'Y' ) ) === gmdate( 'Y' );
