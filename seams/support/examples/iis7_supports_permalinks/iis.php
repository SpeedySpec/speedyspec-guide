<?php
// Whether IIS 7 can serve pretty permalinks: the URL Rewrite module and PHP as FastCGI; iis7_supports_permalinks filters it.
return iis7_supports_permalinks();
