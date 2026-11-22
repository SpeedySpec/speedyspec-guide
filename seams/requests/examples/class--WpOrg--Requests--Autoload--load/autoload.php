<?php
// The autoloader loads WpOrg\Requests classes from their files, and the old Requests_ names (deprecated) as aliases; register() adds it once and defines REQUESTS_AUTOLOAD_REGISTERED.
WpOrg\Requests\Autoload::register();
return array( defined( 'REQUESTS_AUTOLOAD_REGISTERED' ), WpOrg\Requests\Autoload::load( 'WpOrg\\Requests\\Ipv6' ), WpOrg\Requests\Autoload::load( 'Other\\Thing' ), class_exists( 'WpOrg\\Requests\\Utility\\Trim' ), WpOrg\Requests\Utility\Trim::WHITESPACE_CHARS_NO_FF === " \n\r\t\v\x00" );
