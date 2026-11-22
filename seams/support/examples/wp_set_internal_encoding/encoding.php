<?php
// Sets mbstring's internal encoding to the site's charset, when mbstring knows it.
wp_set_internal_encoding();
return mb_internal_encoding();
