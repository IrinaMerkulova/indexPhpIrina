<?php
//fail on loodud parooli krüpteerimiseks
$parool="123456";
$cool="super";
$krypt=crypt($parool,$cool);
echo $krypt;
