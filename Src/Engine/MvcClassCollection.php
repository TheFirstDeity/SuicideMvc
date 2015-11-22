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
 *  Indexes all models, views, and pages. This should probably
 *  be cleaned up or rewritten to some degree.
 */

final class MvcClassCollection
{
    private $models;
    private $views;
    private $controllers;

    public static function Instance()
    {
        static $inst = NULL;

        if ($inst === NULL)
            $inst = new MvcClassCollection();

        return $inst;
    }

    // Name => ClassName
    public function getModels() { return $this->models; }

    // Name => FileName
    public function getViews() { return $this->views; }

    // Name => ClassName
    public function getControllers() { return $this->controllers; }

    
    private function __construct()
    {
        $this->models = $this->_parseDir(MODEL_DIRECTORY, 'Model' . PHP_FILE_EXTENSION);
        $this->views = $this->_parseDir(PAGE_DIRECTORY, PHP_FILE_EXTENSION, FALSE);
        $this->controllers = $this->_parseDir(CONTROLLER_DIRECTORY, 'Controller' . PHP_FILE_EXTENSION);
    }

    // Find all .php files in directory & associates class name with friendly code name
    // (eg. "HomeController.php" could become "home" => "HomeController")
    private function _parseDir($dirPath, $postfix, $removeExtension = TRUE)
    {
        // Note:  This isn't the most versitile function, it serves a specific purpose
        //        and there's need to refactor it or design it better.
        // Note2: Postfix gets removed from KEY, extension gets removed from VALUE
        $result = array();
        $dir = opendir($dirPath);
        
        while ($fname = readdir($dir))
        {
            if ($fname !== $postfix && $this->endsWith($fname, $postfix))
            {
                if ($fname === DEFAULT_PAGE) {
                    break;
                }

                // select part before the "Controller.php" or "Model.php" and make lowercase
                $goodname = strtolower(substr($fname, 0, strlen($fname) - strlen($postfix)));

                // remove extension if needed
                $classname = $removeExtension ?
                    substr($fname, 0, strlen($fname) - strlen(PHP_FILE_EXTENSION)) :
                    $fname;

                $result[$goodname] = $classname;
            }
        }

        closedir($dir);
        return $result;
    }

    // Copied From: http://php.net/ref.strings
    private function endsWith( $str, $sub )
    {
        return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
    }
}
?>