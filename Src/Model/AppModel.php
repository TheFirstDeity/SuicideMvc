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
 *  Provide global init/implememtation for your application's models
 */

class AppModel extends Model
{
    // Default model for use if no table or database exists
    public static function getDefaultModel()
    {
        // TODO: Make class abstract && generate the default dynamically at runtime
        static $instance = NULL;
        if ($instance === NULL) {
            $instance = new AppModel('');
        }
        return $instance;
    }

    public function __construct($tableName)
    {
        parent::__construct($tableName);
    }
}
?>