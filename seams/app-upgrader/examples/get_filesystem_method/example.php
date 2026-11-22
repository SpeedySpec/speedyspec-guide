<?php
// The filesystem method WordPress can write files with: direct when PHP owns the files, else ssh2, ftpext or ftpsockets; FS_METHOD and filesystem_method override it.
return get_filesystem_method();
