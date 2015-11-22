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
 *  Contains global configuration and variables
 */

define('DEBUG_ENABLED', TRUE);
define('USE_TEST_DATABASE', TRUE);
define('DEFAULT_TIMEZONE', 'UTC');

// ------------------------------------------------------
//               ! Database Connection !
// ------------------------------------------------------
static $dbConnArgs = array(
    // Connection Arguments
	'host'     => 'your-db-host.net',
	'login'    => 'root',
	'password' => '',
    'database' => '',

    // SSL File Paths (.pem)
    'sslKeyFile'  => '',
    'sslCertFile' => '',
    'sslCaFile'   => '');

static $dbTestConnArgs = array(); // Used if DEBUG_ENABLED is TRUE
	//'host' => 'localhost',
	//'login' => 'root',
	//'password' => '',
    //'database' => '');
// ------------------------------------------------------
//                 ! Magic Folders !
// ------------------------------------------------------
define('VIEW_DIRECTORY', 'View/');
define('MODEL_DIRECTORY', 'Model/');
define('CONTROLLER_DIRECTORY', 'Controller/');

define('JAVASCRIPT_DIRECTORY', VIEW_DIRECTORY . 'js/');
define('PAGE_DIRECTORY',       VIEW_DIRECTORY . 'Page/');
define('SECTION_DIRECTORY',    VIEW_DIRECTORY . 'Section/');
define('STYLE_DIRECTORY',      VIEW_DIRECTORY . 'Style/');
define('TEMPLATE_DIRECTORY',   VIEW_DIRECTORY . 'Template/');
// ------------------------------------------------------
//               ! Default Behaviors !
// ------------------------------------------------------
define('DEFAULT_TEMPLATE', 'master');
define('DEFAULT_PAGE',     'home');
define('DEFAULT_ACTION',   'index');
// ------------------------------------------------------
//               ! Default View Variables !
// ------------------------------------------------------
// TODO: Move to AppModel or AppController, and make these
//       special names into constants.
function default_view_context() {
    return array(
        'metaTitle'   => 'Suicide MVC',   // Set in "<head><meta>"
        'metaAuthor'  => '',              // Displayed in "#container > #footer" && set in "<head><meta>"
        'heading'     => 'Suicide MVC',   // Displayed in "#container > #header > h1"

        'styleSheets' => 'CakePHP/cake.generic.css', // ';' delimited list of paths from the $viewStyleDirectory
        'jscripts'    => '',             // ';' delimited  list of paths from the $viewJavascriptDirectory
        // 'sections' => 'data_list.php' // (useful to implement?)

        'data' => NULL // used by model, never need to modify
    );
}
// ------------------------------------------------------
//               ! Miscellanious Definitions !
// ------------------------------------------------------
define('PHP_FILE_EXTENSION',        '.php');
define('CSS_FILE_EXTENSION',        '.css');
define('JAVASCRIPT_FILE_EXTENSION', '.js');

define('STATUS_SUCCESS', 1);
define('STATUS_OK', 0);
define('STATUS_ERROR', -1);
// ------------------------------------------------------
?>