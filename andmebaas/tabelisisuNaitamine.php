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
        echo "<td>".htmlspecialchars($kirjeldus). "</td></tr>";
    }
    ?>
    </table>
</body>
</html>
<?php
$yhendus->close();

