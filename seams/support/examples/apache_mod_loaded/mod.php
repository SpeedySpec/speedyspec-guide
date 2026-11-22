<?php
// Whether an Apache module is loaded, from apache_get_modules() or phpinfo(); the default given when it can't tell, and false off Apache.
return array( apache_mod_loaded( 'mod_rewrite' ), $GLOBALS['is_apache'] );
