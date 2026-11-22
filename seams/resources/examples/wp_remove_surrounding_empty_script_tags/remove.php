<?php
// The JavaScript inside an attribute-less script element, for editors' syntax highlighting; anything else gets a doing-it-wrong notice and a console error instead.
return array( wp_remove_surrounding_empty_script_tags( "<script>\nvar a = 1;\n</script>" ), str_starts_with( wp_remove_surrounding_empty_script_tags( 'var a = 1;' ), 'console.error(' ) );
