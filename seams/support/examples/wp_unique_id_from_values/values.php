<?php
// An ID made from data, the same for the same data: the prefix and the first eight characters of the MD5 of its JSON.
return array( wp_unique_id_from_values( array( 'a' => 1 ), 'block-' ), wp_unique_id_from_values( array( 'a' => 1 ), 'block-' ) === wp_unique_id_from_values( array( 'a' => 2 ), 'block-' ) );
