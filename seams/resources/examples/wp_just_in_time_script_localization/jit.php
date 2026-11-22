<?php
// Localizes scripts only when they are used: autosave's interval and the blocked error, mce-view and the like.
wp_just_in_time_script_localization();
return str_contains( (string) wp_scripts()->get_data( 'autosave', 'data' ), 'autosaveInterval' );
