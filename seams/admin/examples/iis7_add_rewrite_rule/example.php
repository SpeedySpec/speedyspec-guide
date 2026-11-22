<?php
// Adds WordPress's rewrite rule to a web.config file, creating the file when missing.
$file = get_temp_dir() . 'guide-web.config';
iis7_add_rewrite_rule( $file, '<rule name="WordPress"><match url="*" /></rule>' );
$exists = iis7_rewrite_rule_exists( $file );
unlink( $file );
return $exists;
