<?php
// The callback for one named entity: kept when HTML allows it, escaped otherwise.
return array( wp_kses_named_entities( array( '&copy;', 'copy' ) ), wp_kses_named_entities( array( '&bogus;', 'bogus' ) ) );
