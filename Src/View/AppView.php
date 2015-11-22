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
 *  Anything in here can be referenced by any page/section/template
 *  file by using the "$this->" accessor syntax.
 */

final class AppView extends View
{
    // this has an ugly name so it's not called accidentally within page/section/template files
    public function show_view_with_context_variables(array $context)
    {
        // Set keys as variables in the local context so they can be accessed directly
        while(list($identifier, $value) = each($context))
        {
            $$identifier = $value;
        }

        require_once($this->template());
    }
}

?>