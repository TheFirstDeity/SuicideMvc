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
 *  Creates creates initializes view, controller, model based on
 *  parameters passed in.
 */

class Dispatcher 
{
    private $controller = NULL;

    private $action = NULL;
    private $argument = NULL;
    private $page = NULL;

    public function __construct($page, $action, $argument)
    {
        // Default to the home page
        if (!is_string($page) || !$page)
            $page = DEFAULT_PAGE;
        if (!is_string($action) || !$action)
            $action = DEFAULT_ACTION;

        $this->action = $action;
        $this->argument = $argument;

        // Discovers the right classes and makes them automatically
        $nameLookups = MvcClassCollection::Instance();
        $modelArr = $nameLookups->getModels();
        $controllerArr = $nameLookups->getControllers();
        $viewArr = $nameLookups->getViews();
        if(array_key_exists($page, $controllerArr) && array_key_exists($page, $viewArr))
        {
            $this->controller = array_key_exists($page, $modelArr) ?
                // Model type is implied if a model's name matches the controller's name
                new $controllerArr[$page](new $modelArr[$page]()) :
                // Otherwise, no model is passed and the controller must create it in its constructor
                new $controllerArr[$page]();

            // TODO: Check if controller class was found, throw error if it wasn't

            $this->page = $viewArr[$page];

            if (!method_exists($this->controller, $action)) {
                // TODO: not-found error page
                if (DEBUG_ENABLED) { throw new BadMethodCallException("A corresponding method named $action was not found for the controller " . get_class($this->controller) . '.'); }
            }
        }
    }

    // Calls action on controller and renders view
    public function execute()
    {
        if ($this->argument === NULL) {
            $this->controller->{$this->action}();
        }
        else {
            $this->controller->{$this->action}($this->argument);
        }

        // TODO: check for non-default template
        $template = DEFAULT_TEMPLATE;

        $view = new AppView($this->page, $template);
        $view->show_view_with_context_variables($this->controller->getModelViewContext());
    }
}
?>