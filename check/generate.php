<?php session_start();

    header("Content-Type: application/octet-stream");
    header("Content-disposition: attachment; filename=\"domains-output.txt\"");
    header("Content-Transfer-Encoding: Binary"); 
    readfile('domains-output.txt');

    EXIT();
 ?>
