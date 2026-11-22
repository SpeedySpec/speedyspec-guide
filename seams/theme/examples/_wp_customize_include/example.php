<?php
// Hooked to plugins_loaded: loads the Customizer manager when the request is for the Customizer, its preview or a changeset.
_wp_customize_include();
return isset( $GLOBALS['wp_customize'] );
