<?php

$start = microtime(true);


define('public1', dirname(__FILE__));
define('ROOT', dirname(public1));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));

require CORE.DS.'includes.php';
new Dispatcher();
?>
<div style="position:fixed; bottom:0; background:#900; color:#fff; line-height:30px; height:30px; left:0; right:0; paddding-left:10px;">
    <?php
    echo 'Page generated in <strong>'.round(microtime(true)-$start, 5).'</strong> seconds';
    ?>
</div>