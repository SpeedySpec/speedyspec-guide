<?php
// A < with no closing > is escaped, so kses doesn't take what follows for a tag; complete tags are left.
return wp_pre_kses_less_than( 'a < b and <b>bold</b> <i' );
