<?php
require("abifunktsioonid.php");
if (isset($_REQUEST["grupilisamine"])) {
    lisaGrupp($_REQUEST["uuegrupinimi"]);
    header("Location: muutmine.php");
    exit();
}
if (isset($_REQUEST["kaubalisamine"])) {
    lisaKaup($_REQUEST["nimetus"], $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
    header("Location: muutmine.php");
    exit();
}
if (isset($_REQUEST["kustutusid"])) {
    kustutaKaup($_REQUEST["kustutusid"]);
}
if (isset($_REQUEST["muutmine"])) {
    muudaKaup($_REQUEST["muudetudid"], $_REQUEST["nimetus"],
        $_REQUEST["kaubagrupi_id"], $_REQUEST["hind"]);
}
$kaubad = kysiKaupadeAndmed();
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Kaupade leht</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
</head>
<body>
<form action="?">
    <h2>Kauba lisamine</h2>
    <dl>
        <dt>Nimetus:</dt>
        <dd><input type="text" name="nimetus"/></dd>
        <dt>Kaubagrupp:</dt>
        <dd><?php
            echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", "kaubagrupi_id");
            ?>
        </dd>
        <dt>Hind:</dt>
        <dd><input type="text" name="hind"/></dd>
    </dl>
    <input type="submit" name="kaubalisamine" value="Lisa kaup"/>
    <h2>Grupi lisamine</h2>
    <input type="text" name="uuegrupinimi"/>
    <input type="submit" name="grupilisamine" value="Lisa grupp"/></form>
<form action="?">
    <h2>Kaupade loetelu</h2>
    <table>
        <tr>
            <th>Haldus</th>
            <th>Nimetus</th>
            <th>Kaubagrupp</th>
            <th>Hind</th>
        </tr>
        <?php foreach ($kaubad as $kaup): ?>
            <tr>
                <?php if (isset($_REQUEST["muutmisid"]) &&
                    intval($_REQUEST["muutmisid"]) == $kaup->id): ?>
                    <td>
                        <input type="submit" name="muutmine" value="Muuda"/> <input type="submit" name="katkestus"
                                                                                    value="Katkesta"/>
                        <input type="hidden" name="muudetudid" value="<?= $kaup->id ?>"/>
                    </td>
                    <td>
                        <input type="text" name="nimetus" value="<?= $kaup->nimetus ?>"/>
                    </td>
                    <td>
                        <?php
                        echo looRippMenyy("SELECT id, grupinimi FROM kaubagrupid", "kaubagrupi_id", $kaup->grupinimi); ?>
                    </td>
                    <td>
                        <input type="text" name="hind" value="<?= $kaup->hind ?>"/>
                    </td>
                <?php else: ?>
                    <td><a href="?kustutusid=<?= $kaup->id ?>"
                           onclick="return confirm('Kas ikka soovid kustutada?')">kustuta</a>
                        <a href="?muutmisid=<?= $kaup->id ?>">muuda</a></td>
                    <td><?= $kaup->nimetus ?></td>
                    <td><?= $kaup->grupinimi ?></td>
                    <td><?= $kaup->hind ?></td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </table>
</form>
</body>
</html>
1. добавить поиск и сортировку в muutmine.php
2. Запрещен ввод пустых значений и ввод цифр в текстовое поле *соответветствие шаблону
3. дружелюбный и удобный интерфейс css.
4. сообщение об ошибке если вводим дублированую категорию товара
5. добавьте что-то своё.
