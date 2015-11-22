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
 *  Base implementation for views. Exposes methods used from
 *  within pages, sections, and templates.
 */

abstract class View
{
    private $_template;
    private $_page;

    final public function __construct($page, $template)
    {
        $this->_page = $page;
        $this->_template = $template;
    }

    // Called by dispatcher to initialize and run the view
    abstract public function show_view_with_context_variables(array $context);

    public function template()
    {
        return $this->_findOrThrow($this->_template, TEMPLATE_DIRECTORY, PHP_FILE_EXTENSION, TRUE);
    }

    public function page()
    {
        return $this->_findOrThrow($this->_page, PAGE_DIRECTORY, PHP_FILE_EXTENSION, TRUE);
    }

    public function section($name, $require = FALSE)
    {
        // The '.php' extension is optional
        // Example 1: include $this->section('my_section_name');
        // Example 2: include $this->section('my_file.php');

        return $this->_findOrThrow($name, SECTION_DIRECTORY, PHP_FILE_EXTENSION, $require);
    }

    public function style($name, $require = FALSE)
    {
        // The '.css' extension is optional
        // Example 1: include $this->style('stylename');
        // Example 2: include $this->style('stylename.css');

        return $this->_findOrThrow($name, STYLE_DIRECTORY, CSS_FILE_EXTENSION, $require);
    }

    public function jscript($name, $require = FALSE)
    {
        // The '.js' extension is optional
        // Example 1: include $this->style('Script.js');
        // Example 2: include $this->style('some_script');

        return $this->_findOrThrow($name, JAVASCRIPT_DIRECTORY, JAVASCRIPT_FILE_EXTENSION, $require);
    }

    // Hidden from access within page/section/template files
    private function _findOrThrow($name, $dir, $ext, $require)
    {
        // Check path with or without filename
        $path = $dir . $name;
        if (file_exists($path)) { return $path; } // is "$name" a file name?
        $pathx = $dir . $name . $ext;
        if (file_exists($pathx)) { return $pathx; } // is "$name.ext" a file name?

        // Not found
        if (!$require) { return $path; } // Not required, so no exception

        // Required file not found
        if (DEBUG_ENABLED) { throw new DomainException("Cannot find required file '$name' or '$name.$ext' in '$dir'."); }
    }
}
?>