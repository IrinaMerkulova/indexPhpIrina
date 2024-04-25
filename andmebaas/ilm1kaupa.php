<?php
require ('conf.php');
global $yhendus;
//kustutamine

if(isset($_REQUEST["kustuta"])){
    $kask=$yhendus->prepare("DELETE FROM ilm WHERE id=?");
    $kask->bind_param("i",$_REQUEST["kustuta"]);
    $kask->execute();

}



//tabeli andmete lisamine
if(isset($_REQUEST["uustemp"]) && !empty($_REQUEST["paev"]) && !empty($_REQUEST["temp"]))  {
    $kask = $yhendus->prepare("INSERT INTO ilm(kuupaev, temp, kirjeldus, varv) VALUES (?,?,?,?)");
    $kask->bind_param("siss", $_REQUEST["paev"], $_REQUEST["temp"], $_REQUEST["kirjeldus"], $_REQUEST["varv"]);
    //s-string, d-double, i-integer
    $kask->execute();
}




?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabeli 'ilm' sisu vaatamine</title>

</head>
<body>
<h1>Näitame temperatuuri kui click kuupäeva peale</h1>
<?php
//tabeli sisu vaatamine

$kask=$yhendus->prepare("SELECT id, kuupaev FROM ilm ORDER by kuupaev DESC");
$kask->bind_result($id, $kuupaev);
$kask->execute();
echo "<ul>";
while($kask->fetch()){
    echo "<li><a href='?ilm_id=$id'>".$kuupaev."</a></li>";

}
echo "</ul>";
echo "<li><a href='?lisa=jah'>Lisa uus temperatuur...</a>"
?>
<div id="sisu">
    <?php

    if(isset($_REQUEST["ilm_id"])){

        $kask=$yhendus->prepare("SELECT id, kuupaev, temp, kirjeldus, varv
FROM ilm WHERE id=?");
        $kask->bind_result($id, $kuupaev, $temp, $kirjeldus, $varv);
        $kask->bind_param("i", $_REQUEST["ilm_id"]);
        $kask->execute();
        //näitame 1kaupa id järgi
        if($kask->fetch()){

            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>$id</th>";
            echo "<th bgcolor='$varv'>$kuupaev</th>";
            echo "<th>Tempetuur: ".$temp. "kraadi</th>";
            echo "<th><img src='$kirjeldus' alt='pilt' width='50%'></th>";
            echo "<th><a href='?kustuta=$id'>Kustuta</a>";
            echo "</tr>";
            echo "</table>";
        }
    }

    ?>
</div>
<?php
if(isset($_REQUEST["lisa"])){
?>
<form action="?" method="post">
    <input type="hidden" value="jah" name="uustemp">
    <label for="paev">Kuupäev</label>
    <input type="date" name="paev" id="paev">
    <br>
    <label for="temp">Temperatuur</label>
    <input type="number" name="temp" id="temp">
    <br>
    <label for="kirjeldus">Kirjeldus</label>
    <textarea name="kirjeldus" id="kirjeldus">
    </textarea>
    <label for="varv">Värv</label>
    <input type="color" name="varv" id="varv">
    <br>
    <input type="submit" value="Lisa tabelisse" name="submit">

</form>
<?php
}
?>

</body>
</html>