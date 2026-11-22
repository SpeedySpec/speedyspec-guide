<?php
// Sets the text domain (and folder) of a script module's translations; false for an unknown module.
wp_register_script_module( '@guide/app', 'https://cdn.example/app.js' );
return array( wp_set_script_module_translations( '@guide/app', 'guide' ), wp_set_script_module_translations( '@guide/nope', 'guide' ) );
