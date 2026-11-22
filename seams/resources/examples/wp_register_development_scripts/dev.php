<?php
// Registers React's fast refresh scripts when SCRIPT_DEBUG is on and React is registered, as in a development build like this one.
return array( isset( wp_scripts()->registered['wp-react-refresh-entry'] ), SCRIPT_DEBUG );
