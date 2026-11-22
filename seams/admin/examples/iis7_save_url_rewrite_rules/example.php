<?php
// Writes WordPress's rewrite rules into web.config on IIS 7 with its rewrite module, when it can; gives whether it did.
return iis7_save_url_rewrite_rules();
