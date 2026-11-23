<?php
// Records a message to show at the top of a settings page: an error, success, warning or info notice.
add_settings_error( 'tea_blend', 'too_strong', 'That blend is too strong.' );
return get_settings_errors( 'tea_blend' );
