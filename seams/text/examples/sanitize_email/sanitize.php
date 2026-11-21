<?php
// Removes characters an address can't have, or returns an empty string when it can't be one.
return array( sanitize_email( ' me()@example.org ' ), sanitize_email( 'nope' ) );
