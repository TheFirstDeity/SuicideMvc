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
 *  Base implementation for all controllers.
 */

// DO NOT MODIFY, Customize AppController instead
abstract class Controller
{
    private $debuggingLogAssoc = array();

    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }


    // -------- Shortcuts --------
    final protected function flash($message, $status = STATUS_OK)
    {
        // Sets a styled message at the top of the screen
        // --->$status: STATUS_SUCCESS, STATUS_OK, STATUS_ERROR
        $this->model->set('flashMessage', $message);
        $this->model->set('flashStatus', $status);
    }

    final protected function set($name, $value) { $this->model->set($name, $value); } // Shortcut to model->set
    final protected function get($name) { return $this->model->get($name); } // Shortcut to model->get

    final protected function heading($heading)   // Displayed in #header > <h1>
        { $this->model->set('heading', $heading); }

    final protected function title($title)       // set 'head > title'
        { $this->model->set('metaTitle', $title); }

    final protected function subtitle($subtitle) // Append to 'head > title'
        { $this->model->set('metaTitle', $this->model->get('metaTitle') . ' | ' . $subtitle); }

    final protected function author($name)        // set 'head > title[author]' AND copyright in '#footer'
        { $this->model->set('metaAuthor', $name); }

    // -------- Scripts & Styles --------
    final protected function execJs($javascript) // injects some arbitrary javascript
        { echo "<script type='text/javascript'>$javascript</script>"; }

    final protected function styles($stylesheets) // replaces styles
        { $this->model->set('styleSheets', $stylesheets); }

    final protected function jscriptAdd($jscript) // appends a script url
        {  $this->model->set('jscripts', $this->model->get('jscripts') . ';' . $jscript); }

    // -------- Debugging --------
    final protected function log($message, $status = STATUS_OK) // log debugging messsage
    { 
        // int $status: STATUS_SUCCESS, STATUS_OK, STATUS_ERROR
        $this->debuggingLogAssoc[$message] = $status;
        $this->model->set('debuggingLogAssoc', $this->debuggingLogAssoc); 
    }

    final protected function log_dump($var, $status = STATUS_OK) // log a var_dump
    { 
        // int $status: STATUS_SUCCESS, STATUS_OK, STATUS_ERROR
        $this->debuggingLogAssoc[$this->_svar_dump($var)] = $status;
        $this->model->set('debuggingLogAssoc', $this->debuggingLogAssoc); 
    }

    final protected function log_database_debug()
    {
        // logs the values automatically set when a DB operation fails
        if (DEBUG_ENABLED) {
            $this->log($this->get('debug_sql'), STATUS_OK);
            if ($error = $this->get('debug_data_error')) {
                $errno = $this->get('debug_data_errno');
                $this->log("Error# $errno, $error", STATUS_ERROR);
            }
        }
    }

    // -------- Implementation (see Dispatcher.php) --------
    public function getModelViewContext()
    {
        return $this->model->getViewContext();
    }

    private function _svar_dump($var)
    {
        ob_start();
        var_dump($var);
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}
?>