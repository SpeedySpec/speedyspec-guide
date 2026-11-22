<?php
// The log in URL with a redirect and forced reauth; filtered by login_url.
return array( wp_login_url(), wp_login_url( home_url( '/after' ), true ) );
