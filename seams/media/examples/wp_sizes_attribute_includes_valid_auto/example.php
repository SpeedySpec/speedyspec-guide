<?php
// Whether a sizes attribute value starts with auto.
return array( wp_sizes_attribute_includes_valid_auto( 'auto, 300px' ), wp_sizes_attribute_includes_valid_auto( 'AUTO' ), wp_sizes_attribute_includes_valid_auto( '300px, auto' ) );
