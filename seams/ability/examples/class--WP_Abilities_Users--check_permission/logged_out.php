<?php
// It needs a logged-in user; the roles and usernames filters also need list_users.
guide_core_abilities();
return wp_get_ability( 'core/users-query' )->execute()->get_error_code();
