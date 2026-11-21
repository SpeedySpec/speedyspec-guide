<?php
// Accepts an ORDER BY clause only when it is plain column names and directions, or RAND().
return array( sanitize_sql_orderby( 'post_date DESC, ID' ), sanitize_sql_orderby( 'ID; DROP TABLE x' ) );
