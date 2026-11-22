<?php
// Whether the post being shown in the loop has a different date from the one before it: 1 or 0, from $currentday and $previousday.
$GLOBALS['currentday'] = '01.03.26';
$GLOBALS['previousday'] = '28.02.26';
$new = is_new_day();
$GLOBALS['previousday'] = '01.03.26';
return array( $new, is_new_day() );
