<?php
// The suffix of script and style files: .min unless SCRIPT_DEBUG; dev gives .min unless WordPress is a development build (-src). Both are empty in this build.
return array( wp_scripts_get_suffix(), wp_scripts_get_suffix( 'dev' ) );
