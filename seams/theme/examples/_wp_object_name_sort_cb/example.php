<?php
// Compares two terms by name, for sorting the tag cloud.
return _wp_object_name_sort_cb( (object) array( 'name' => 'apple' ), (object) array( 'name' => 'Banana' ) ) < 0;
