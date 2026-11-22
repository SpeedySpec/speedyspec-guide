<?php
// A duration like HH:MM:SS (or MM:SS) in words; false when it isn't in that form or has too many parts.
return array( human_readable_duration( '01:02:03' ), human_readable_duration( '5:07' ), human_readable_duration( 'abc' ) );
