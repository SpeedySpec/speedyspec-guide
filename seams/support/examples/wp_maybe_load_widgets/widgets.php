<?php
// Loads the widgets API and adds the Widgets menu, unless load_default_widgets turns it off.
wp_maybe_load_widgets();
return array( class_exists( 'WP_Widget_Text' ), has_action( '_admin_menu', 'wp_widgets_add_menu' ) );
