<?php
// Reads an option straight from the options table during install and upgrade, before the options API can be trusted.
return array( __get_option( 'siteurl' ), __get_option( 'nonesuch' ) );
