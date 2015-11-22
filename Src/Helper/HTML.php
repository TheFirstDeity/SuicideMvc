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

class HTML
{
    public static function h1($inner) { return '<h1>' . $inner . '</h1>'; }
    public static function h2($inner) { return '<h2>' . $inner . '</h2>'; }
    public static function h3($inner) { return '<h3>' . $inner . '</h3>'; }
    public static function h4($inner) { return '<h4>' . $inner . '</h4>'; }
    public static function p($inner) { return '<p>' . $inner . '</p>'; }
    public static function span($inner) { return '<span">' . $inner . '</span>'; }
    public static function pre($inner) { return '<pre>' . $inner . '</pre>'; }
    
    public static function thr($array) {
        $result = '<tr>';
        foreach($array as $header) {
            $result .= '<th>' . $header . '</th>';
        }
        return $result .= '</tr>';
    }

    public static function tdr($array) {
        $result = '<tr>';
        foreach($array as $field) {
            $result .= '<td>' . $field . '</td>';
        }
        return $result .= '</tr>';
    }

    // Includes
    public static function link_style($url) {
        return "<link rel='stylesheet' type='text/css' href='$url'>";
    }
    public static function link_jscript($url) {
        return "<script type='text/javascript' src='$url'></script>";
    }

    // Forms
    //-------------------
    public static function input_text($name, $label = NULL) {
        if ($label = NULL) { $label = $name; }
        return "<label for='$name'>$label</label>:&nbsp;<input type='text' name='$name'/>";
    }

    // CSS Specific (need to change this garbage)
    //-------------------
    public static function success($inner) { return '<span class="success">' . $inner . '</span>'; }
    public static function notice($inner) { return '<span class="notice">' . $inner . '</span>'; }
    public static function message($inner) { return '<span class="message">' . $inner . '</span>'; }
    public static function notice_success($inner) { return '<span class="notice success">' . $inner . '</span>'; }
    public static function error_message($inner) { return '<span class="error-message">' . $inner . '</span>'; }

    public static function error_p($inner) { return '<p class="error">' . $inner . '</p>'; }
    public static function success_p($inner) { return '<p class="success">' . $inner . '</p>'; }
    public static function notice_p($inner) { return '<p class="notice">' . $inner . '</p>'; }
    public static function message_p($inner) { return '<p class="message">' . $inner . '</p>'; }


    // .actions ul li a input[type=submit]

    // Debug Specific
    //-------------------
    // pre  .cake-debug-output > span  .cake-debug  .cake-error > a
}

?>