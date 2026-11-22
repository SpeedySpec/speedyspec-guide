<?php
// A list of unique non-negative integers (each value through absint()) from an array or a comma or space separated string; the keys of the first occurrences are kept.
return wp_parse_id_list( '3, 5, 5, -2 abc 7' );
