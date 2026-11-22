<?php
// Cleans one user field for a context: IDs as integers, logins and emails filtered by their pre_ and edit_ and display filters, URLs escaped for display.
return array( sanitize_user_field( 'ID', '7x', 1, 'display' ), sanitize_user_field( 'user_url', 'javascript:alert(1)', 1, 'display' ), sanitize_user_field( 'display_name', '<b>A</b> & B', 1, 'display' ), sanitize_user_field( 'user_login', 'Ad min', 1, 'db' ) );
