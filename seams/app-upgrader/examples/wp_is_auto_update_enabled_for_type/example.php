<?php
// Whether users may turn automatic updates on for plugins or themes; filtered by plugins_auto_update_enabled and themes_auto_update_enabled.
return array( wp_is_auto_update_enabled_for_type( 'plugin' ), wp_is_auto_update_enabled_for_type( 'theme' ), wp_is_auto_update_enabled_for_type( 'core' ) );
