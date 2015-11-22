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
 *  
 */

if (isset($flashMessage)) {
    if (!isset($flashStatus)) {
        $flashStatus = STATUS_OK; // neutral message
    }

    if ($flashStatus > STATUS_OK) {
        echo html::p(html::notice_success($flashMessage));
    } else if ($flashStatus < STATUS_OK) {
        echo html::error_p($flashMessage);
    } else {
        echo html::p(html::notice($flashMessage));
    }
}

?>