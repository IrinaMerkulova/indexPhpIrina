<?php
require ('conf.php');
//tabeli sisu vaatamine
global $yhendus;
$kask=$yhendus->prepare("SELECT id, kuupaev, temp, kirjeldus 
FROM ilm ORDER by kuupaev DESC");
$kask->bind_result($id, $kuupaev, $temp, $kirjeldus);
$kask->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabeli 'ilm' sisu vaatamine</title>
<!--    https://meet.google.com/huy-zvrz-yei-->
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
        echo "<td><img src='$kirjeldus' alt='pilt' width='100'></td></tr>";
    }
    ?>
    </table>
<div>
    <h2>Ülesanne: Matka leht</h2>
    <ul>
   <li> Lisa uue tabeli andmebaasi. (tabelinimi osalejad (id, nimi, telefon, pilt,  synniaeg)

    <li> Loo leht kasutajate lisamiseks matkale:* nimi, telefon, pilt, synniaeg

        <li> Samal lehel näita kes on matkale registreerinud koos pildiga. Info näidatakse tabelina.

        <li>Lisa tabelisse osaleja kustutamine ja vanuse arvutamine(vanuse arvutamiseks kasuta vajaliku php kuupäeva funktsiooni - otsi siin - https://www.metshein.com/unit/php-ajafunktsioonid-ulesanne-8/)
        </li>
    </ul>
</div>
</body>
</html>
<?php
$yhendus->close();

