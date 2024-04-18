<?php
$kasutaja="d70420_merk21";
$parool="...";
$andmebaas="d70420_merk21";
$serverinimi="d70420.mysql.zonevs.eu";

$yhendus=new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset("UTF8");
/*
 * CREATE TABLE ilm(
    id int PRIMARY KEY AUTO_INCREMENT,
    kuupaev date,
    temp int,
    kirjeldus TEXT)*/