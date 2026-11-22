<?php
// Removes WordPress's rewrite rules from a web.config file.
$file = get_temp_dir() . 'guide-web.config';
iis7_add_rewrite_rule( $file, '<rule name="WordPress"><match url="*" /></rule>' );
iis7_delete_rewrite_rule( $file );
$exists = iis7_rewrite_rule_exists( $file );
unlink( $file );
return $exists;
