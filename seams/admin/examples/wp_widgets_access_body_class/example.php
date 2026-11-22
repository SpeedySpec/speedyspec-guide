<?php
// Hooked to admin_body_class: adds widgets_access when the user turned on accessibility mode for widgets.
set_user_setting( 'widgets_access', 'on' );
return wp_widgets_access_body_class( 'wp-admin' );
