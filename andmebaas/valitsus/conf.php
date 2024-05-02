<?php
$kasutaja="irinaveeb";
$parool="12345";
$andmebaas="irinaveeb";
$serverinimi="localhost";

$yhendus=new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset("UTF8");