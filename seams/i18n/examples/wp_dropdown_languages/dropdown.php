<?php
// A select of the available languages, with English first; here the translations API isn't asked for more.
return wp_dropdown_languages( array( 'echo' => 0, 'languages' => array( 'fr_FR' ), 'translations' => array( 'fr_FR' => array( 'language' => 'fr_FR', 'native_name' => 'Français', 'iso' => array( 'fr' ) ) ), 'selected' => 'fr_FR', 'show_available_translations' => false ) );
