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
 *  Base for your application's controllers, add your own
 *  customizations into here.
 */

abstract class AppController extends Controller
{
    public function __construct($model = NULL)
    {
        // A defalult model is used for cases where there's no table/database
        if ($model === NULL) { $model = AppModel::getDefaultModel(); }
        parent::__construct($model);
    }
}

?>