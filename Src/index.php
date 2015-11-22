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
 *  This is the root index file that handles requests by 
 *  handing the GET variables off to the dispatcher.
 */

require_once('Config/global.php');
require_once('Config/global_script.php');

// Dispatcher initializes the controller and view.
$dispatcher = new Dispatcher(
    isset($_GET['page']) ? $_GET['page'] : NULL,
    isset($_GET['action']) ? $_GET['action'] : NULL,
    isset($_GET['argument']) ? $_GET['argument'] : NULL);
$dispatcher->execute();
?>