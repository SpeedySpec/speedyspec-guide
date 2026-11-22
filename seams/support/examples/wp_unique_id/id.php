<?php
// A number unique within the request, after a prefix.
return array( wp_unique_id( 'field-' ) !== wp_unique_id( 'field-' ), str_starts_with( wp_unique_id( 'x-' ), 'x-' ) );
