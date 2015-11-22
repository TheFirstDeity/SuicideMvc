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
 *  This was intended to make models aware of the database
 *  schema, but I think I'll replace it with some kind of
 *  better technique.
 */

class Schema
{
    // Basic schema table & field info for error checking
    // i=int, d=double, s=string, b=blob
    private static $tables = array(

    );

    public static function tables() { return self::$tables; }

    public static function definition($tableName)
    {
        if (!$tableName || !is_string($tableName)) { return NULL; }//throw new BadMethodCallException('$tableName must be a string and cannot be empty'); }
        return array_key_exists($tableName, self::$tables[$tableName]) ? self::$tables[$tableName] : NULL;
    }
}

?>