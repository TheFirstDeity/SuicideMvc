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
 *  Default master template with basic section-slots for
 *  header, content, footer, style-includes, script-includes,
 *  and the debugging log section.
 */

// TODO: Move this into View.php
function put_links($namelist, $obj, $funcfind, $funcformat) {
    foreach(explode(';', $namelist) as $name) {
        if ($name && $found = $obj->$funcfind($name)) {
            echo HTML::$funcformat($found); // relative path from script
        } else if ($name) {
            echo HTML::$funcformat($name);  // url on web
        }
    }
}
            
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo isset($metaTitle) ? $metaTitle : ''; ?></title>
        <meta name="author" content="<?php if (isset($metaAuthor)) echo $metaAuthor; ?>">
<!-- Stylesheets --><?php if (isset($styleSheets)) { put_links($styleSheets, $this, 'style', 'link_style'); } // TODO: else {warning} ?>

    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php if (isset($heading)) echo $heading; // TODO: else {warning} ?></h1>
            </div>
            <div id="content">
                <?php include $this->section('flash'); ?>
                <?php include_once $this->page(); ?>
            </div>
            <div id="footer">
                <?php if (isset($metaAuthor)) echo '&copy;' . date('Y') . ' ' . $metaAuthor; ?>
            </div>
            <?php if (DEBUG_ENABLED) include $this->section('debug'); ?>
        </div>
<!-- Javascript --><?php if (isset($jscripts)) { put_links($jscripts, $this, 'jscript', 'link_jscript'); } // TODO: else {warning} ?>

    </body>
</html>
