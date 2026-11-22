<?php
// Registers a plugin's folder for its text domain and returns true; the translations themselves load just in time, from WP_LANG_DIR/plugins first. load_muplugin_textdomain() the same for must-use plugins.
switch_to_locale( 'fr_FR' );
return array( load_plugin_textdomain( 'guide' ), __( 'Hello', 'guide' ), load_plugin_textdomain( 'other' ), load_muplugin_textdomain( 'other-mu' ) );
