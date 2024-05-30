<?php
require("abifunktsioonid.php");
session_start();
// tagab, et sessioonis on admini staatus alati olemas, vaikimisi on false
if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
//kaubagrupi lisamine
if(isSet($_REQUEST["grupilisamine"]) && !empty($_REQUEST["uuegrupinimi"])){
    lisaGrupp($_REQUEST["uuegrupinimi"]);
    header("Location: kaubahaldus.php");
    exit();

}
//kauba lisamine
if(isSet($_REQUEST["kaubalisamine"]) && !empty($_REQUEST["nimetus"])){
    lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
    header("Location: kaubahaldus.php");
    exit();

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
<?php
if(!isAdmin()) {
?>
    <h1>Kaupade leht</h1>
    <form action="?">
            <label for="otsisona">Otsi nimetuse või kaubagrupi järgi:</label>
            <br>
            <input type="text" name="otsisona" id="otsisona">
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
                <?php endforeach; ?>
            </table>
    </form>
<?php
} else {
?>
    <form action="?">
        <h2>Kauba lisamine</h2>
        <dl>
            <dt>Nimetus:</dt>
            <dd><input type="text" name="nimetus" /></dd>
            <dt>Kaubagrupp:</dt>
            <dd><?php
                echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid",   "kaubagrupi_id");
                ?>
            </dd>
            <dt>Hind:</dt>
            <dd><input type="text" name="hind" /></dd>
        </dl>
        <input type="submit" name="kaubalisamine" value="Lisa kaup" />
        <h2>Kaubagrupi lisamine</h2>
        <input type="text" name="uuegrupinimi" />
        <input type="submit" name="grupilisamine" value="Lisa grupp" />
    </form>
<?php } ?>
</body>
</html>