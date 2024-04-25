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
if(isset($_REQUEST["paev"]) && !empty($_REQUEST["paev"]) && !empty($_REQUEST["temp"]))  {
    $kask = $yhendus->prepare("INSERT INTO ilm(kuupaev, temp, kirjeldus) VALUES (?,?,?)");
    $kask->bind_param("sis", $_REQUEST["paev"], $_REQUEST["temp"], $_REQUEST["kirjeldus"]);
    //s-string, d-double, i-integer
    $kask->execute();
}
//tabeli sisu vaatamine

$kask=$yhendus->prepare("SELECT id, kuupaev, temp, kirjeldus 
FROM ilm ORDER by kuupaev DESC");
$kask->bind_result($id, $kuupaev, $temp, $kirjeldus);
$kask->execute();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabeli 'ilm' sisu vaatamine</title>

</head>
<body>
    <h1>Tabeli 'ilm' sisu vaatamine</h1>
    <table border="1">
        <tr>
            <th>Nr</th>
            <th>Kuupäev</th>
            <th>Temperatuur</th>
            <th>Kirjeldus</th>
        </tr>
    <?php
    while($kask->fetch()){
        echo "<tr><td>".$id. "</td>";
        echo "<td>".htmlspecialchars($kuupaev). "</td>";
        echo "<td>". $temp.  "</td>";
        echo "<td><img src='$kirjeldus' alt='pilt'></td>";
        echo "<td><a href='?kustuta=$id'>Kustuta</a></td></tr>";
    }
    ?>
    </table>
<form action="?" method="post">
    <label for="paev">Kuupäev</label>
    <input type="date" name="paev" id="paev">
    <br>
    <label for="temp">Temperatuur</label>
    <input type="number" name="temp" id="temp">
    <br>
    <label for="kirjeldus">Kirjeldus</label>
    <textarea name="kirjeldus" id="kirjeldus">
    </textarea>
    <br>
    <input type="submit" value="Lisa tabelisse" name="submit">
    
</form>

</body>
</html>


