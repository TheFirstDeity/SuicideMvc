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
?>

<div class="cake-debug-output cake-debug">
<?php 
    //function format_message($message, $status = STATUS_OK) {
    //    if ($status > STATUS_OK) {
    //        //return TODO
    //    } else if ($status < STATUS_OK) {
    //        //return TODO
    //    }
    //    //return TODO
    //}

    if (isset($debuggingLogAssoc)) {
        // Note: Status is ignored for now (depricate or implement?)
        foreach($debuggingLogAssoc as $message => $status) {
            static $entryNo = 0;
            echo HTML::span(HTML::p(++$entryNo . '. ' . $message));
            //echo format_message($message, $status); 
        }
    }
?>
</div>