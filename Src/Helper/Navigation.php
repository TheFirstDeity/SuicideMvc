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
 *  Static helper class with some basic navigation/redirect capabilities
 */

class Navigation
{
    public static function mklink($page, $action = '', $argument = '')
    {
        if (!$page ||!is_string($page)) { throw new BadMethodCallException('$page must be a string and cannot be empty'); }

        global $defaultAction;
        $actParam = $action ? $action : $defaultAction;
        $argParam = $argument ? ('&argument=' . $argument) : '';
        return ('index.php/?page=' . $page . '&action=' . $actParam . $argParam);
    }

    //public static function mklink($page, $action = '', $argument = '')
    //{
    //    if (!$page ||!is_string($page)) { throw new BadMethodCallException('$page must be a string and cannot be empty'); }

    //    global $defaultAction;
    //    $actParam = $action ? $action : $defaultAction;

    //    return $action ? "/$page/$action/$argument" : "/$page/$action";
    //}

    public static function redirectJs($page, $action = '', $argument = '')
    {
        echo "<script type='text/javascript'>window.location = 'index.php?page=$page&action=$action&argument=$argument';</script>";
        exit(0);
    }

    public static function redirect($page, $action = '', $argument = '')
    {
        header('Location: ' . self::mklink($page, $action, $argument), TRUE, 302);
        exit(0);
    }

    //protected function notfounderror()
    //{
    //    header('Location: ' . navigation::mklink('home', 'error'), TRUE, 404);
    //    exit(1);
    //}
}

?>