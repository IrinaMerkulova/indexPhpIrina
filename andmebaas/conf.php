<?php
$kasutaja="irinaveeb";
$parool="12345";
$andmebaas="irinaveeb";
$serverinimi="localhost";

$yhendus=new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset("UTF8");
/*
 * CREATE TABLE ilm(
    id int PRIMARY KEY AUTO_INCREMENT,
    kuupaev date,
    temp int,
    kirjeldus TEXT)*/