<?php
    require ('conf.php');
    global $yhendus;
    //kustutamine
if(isset($_REQUEST['kustuta'])) {
    $kask = $yhendus->prepare("DELETE FROM valitsus WHERE id=?");
    $kask->bind_param('i', $_REQUEST['kustuta']);
    $kask->execute();
    header("location: $_SERVER[PHP_SELF]");
}

    //punkti lisamine UPDATE
if(isset($_REQUEST['pluss_id'])) {
    $kask = $yhendus->prepare("UPDATE valitsus SET punktid=punktid+1 WHERE id=?");
    $kask->bind_param('i', $_REQUEST['pluss_id']);
    $kask->execute();
    header("location: $_SERVER[PHP_SELF]");
}
//-1punkt
if(isset($_REQUEST['miinus_id'])) {
    $kask = $yhendus->prepare("UPDATE valitsus SET punktid=punktid-1 WHERE id=?");
    $kask->bind_param('i', $_REQUEST['miinus_id']);
    $kask->execute();
    header("location: $_SERVER[PHP_SELF]");
}
//kommentaari lisamine
if(isset($_REQUEST['uuskomment_id']) && !empty($_REQUEST['komment'])) {
    $kask = $yhendus->prepare("UPDATE valitsus SET kommentaarid=CONCAT(kommentaarid, ?) WHERE id=?");
    $lisakomment=$_REQUEST['komment']."\n";
    $kask->bind_param('si', $lisakomment,$_REQUEST['uuskomment_id']);
    $kask->execute();
    header("location: $_SERVER[PHP_SELF]");
}

//lisamine tabelisse
if(isset($_REQUEST['uusvalitsus']) && !empty($_REQUEST['valitsusenimi'])) {

    $kask=$yhendus->prepare("INSERT INTO valitsus (valitsuseSeis,lisamisKuupaev) VALUES (?, NOW())");
    $kask->bind_param('s', $_REQUEST['valitsusenimi']);
    $kask->execute();
    header("location: $_SERVER[PHP_SELF]");

}

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Hääletamise leht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Vali oma valitsus ja hääleta!</h1>
<table>
    <tr>
        <th>ValitsuseSeis</th>
        <th>LisamisKuupäev</th>
        <th>Punktid</th>
        <th>Kommentaarid</th>
        <th>Tegevus</th>
    </tr>
    <?php
    //tabeli sisu näitamine andmebaasist
    global $yhendus;
    $kask=$yhendus->prepare("
Select id, valitsuseSeis, punktid, kommentaarid, lisamisKuupaev from valitsus");
    $kask->bind_result($id, $valitsusSeis, $punktid, $kommentaarid, $lisamisKuupaev);
    $kask->execute();
    while($kask->fetch()){
        echo "<tr>";
        echo "<td>".htmlspecialchars($valitsusSeis)."</td>";
        echo "<td>".$lisamisKuupaev."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".nl2br(htmlspecialchars($kommentaarid))."
<form method='post' action='?'>
<input type='hidden' name='uuskomment_id' value='$id'>
    <input type='text' name='komment'>
    <input type='submit' value='Lisa kommentaari'>
</form>
</td>";
        echo "<td>
<a href='?pluss_id=$id'>+1punkt</a>
<br>
<a href='?miinus_id=$id'>-1punkt</a>
<br>
<a href='?kustuta=$id'>Kustuta</a>
</td>";
        echo "</tr>";
        // Zebra table css
    }
    ?>
</table>
    <a href="?lisa=jah">Lisa uus valitsus</a>
    <?php
    if(isset($_REQUEST['lisa'])) {
    ?>

<form action="?" method="post">
    <input type="hidden" name="uusvalitsus" value="jah">
    <label for="valitsusenimi">Valitsuse nimi:</label>
    <input type="text" name="valitsusenimi" id="valitsusenimi">
    <input type="submit" value="Lisa">

</form>
    <?php
    }/* Ülesanne.
1. Näita php lehel ainult valitsuse Nimed
2. Kui klickida valitsuse nimel siis kuvatakse info: punktid, kommentaarid jne,
punktid ja kommentaarid saab lisada ja kustutada ka.*/

    ?>
</body>
</html>

