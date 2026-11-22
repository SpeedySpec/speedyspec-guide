<?php
// A user ID by login, or false; username_exists filters it.
return array( username_exists( 'admin' ), username_exists( 'nobody' ) );
