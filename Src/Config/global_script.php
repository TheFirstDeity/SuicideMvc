<?php
/**
 *  ====== COPYRIGHT ======
 *  Suicide MVC, A Simple RAD Framework
 *  Copyright (c) Devin Ireland, http://devinireland.com
 *
 *  Licensed under The Microsoft Public License
 *  See LICENSE-SMVC.txt in the root folder of this source code.
 *  Redistributions of files must retain this copyright notice.
 *  =======================
 *  
 *  ----- File Description -----
 *  Any scripts or includes that should happen before the dispatcher runs.
 */

if (!date_default_timezone_set(DEFAULT_TIMEZONE) && DEBUG_ENABLED) {
    // TODO: Show a warning instead of crashing the site
    throw new RuntimeException('Could not set default timezone');
}

// Auto-loads classes without the need for include statements, as long as the class name matches the file name.
spl_autoload_register(function($cName)
    {
        // TODO: have this search the file heirarchy without hard-coded names
        static $dirs;
        if (!$dirs) {
            $dirs = array(
                'Config/',
                'Controller/',
                'Engine/',
                'Helper/',
                'Model/',
                'View/');
            }

        foreach($dirs as $dir) {
            $path = $dir . $cName . '.php';
            if(file_exists($path)) {
                require_once($path);
                break;
            }
        }
    });
?>