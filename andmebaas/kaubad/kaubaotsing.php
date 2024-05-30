<?php
require("abifunktsioonid.php");
session_start();
// tagab, et sessioonis on admini staatus alati olemas, vaikimisi on false
if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
// $kaubad=kysiKaupadeAndmed();
$sorttulp="nimetus";
$otsisona="";
if(isSet($_REQUEST["sort"])){
    $sorttulp=$_REQUEST["sort"];
}
if(isSet($_REQUEST["otsisona"])){
    $otsisona=$_REQUEST["otsisona"];
}
$kaubad=kysiKaupadeAndmed($sorttulp, $otsisona);
// funktsioon mis käivitab sessioni admin
function isAdmin(){
    return isset($_SESSION['admin']) && $_SESSION['admin'];
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Kaupade leht</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<!--logout nupp-->
<?php
if(isset($_SESSION["kasutaja"])){
?>
<h1>Salajane info</h1>
<p>Tere, <?="$_SESSION[kasutaja]"?>

    </p>
<form action="logout.php" method="post">
    <input type="submit" value="Logi välja" name="logout">
</form>
<?php
} else {
   echo" <form action='login2.php' method='post'>
    <input type='submit' value='Login' name='login'>
</form>";
}
?>

<h1>Kaupade leht</h1>


<form action="?">
    <?php
    if(!isAdmin()){
    ?>
    <label for="otsisona">Otsi nimetuse või kaubagrupi järgi:</label>
    <br>
    <input type="text" name="otsisona" id="otsisona">
<?php } else { ?>

    <table>
    <tr>
        <th><a href="?sort=nimetus">Nimetus</a></th>
        <th><a href="?sort=grupinimi">Kaubagrupp</a></th>
        <th><a href="?sort=hind">Hind</a></th>
    </tr>
    <?php foreach($kaubad as $kaup): ?>
        <tr>
            <td><?=$kaup->nimetus ?></td>
            <td><?=$kaup->grupinimi ?></td>
            <td><?=$kaup->hind ?></td>
        </tr>
    <?php endforeach;
    }
?>
</table>
</form>
</body>
</html>