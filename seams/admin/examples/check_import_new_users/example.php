<?php
// Hooked to import_allow_create_users on a network: only super admins may create users while importing.
return check_import_new_users( true );
