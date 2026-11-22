<?php
switch_to_locale( 'fr_FR' );
// Registers a must-use plugin's folder for a text domain; the translations load just in time.
return load_muplugin_textdomain( 'guide-mu', 'guide-mu/languages' );
