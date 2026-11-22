<?php
// A user's WP_User by id, slug, email or login, or false.
return array( get_user_by( 'email', 'admin@example.org' )->ID, get_user_by( 'login', 'nobody' ), get_user_by( 'id', 1 )->user_login );
