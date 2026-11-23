<?php
// Whether a web.config file has WordPress's rewrite rule.
$file = get_temp_dir() . 'guide-web.config';
$before = iis7_rewrite_rule_exists( $file );
iis7_add_rewrite_rule( $file, '<rule name="WordPress"><match url="*" /></rule>' );
$after = iis7_rewrite_rule_exists( $file );
unlink( $file );
return array( $before, $after );
