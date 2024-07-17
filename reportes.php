<?php
require_once("classes/class_reportes.php");

$obj = new reportes();
switch($obj->mod) {
    default: 
        $obj->form();
        break;
}
?>
