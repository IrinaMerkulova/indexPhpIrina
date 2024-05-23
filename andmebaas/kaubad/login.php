<?php include('conf.php'); ?>
<?php
session_start();
global $yhendus;
/*if (isset($_SESSION['tuvastamine'])) {
    header('Location: 07_admin.php');
    exit();
}*/
//kontrollime kas väljad on täidetud
if (!empty($_POST['login']) && !empty($_POST['pass'])) {
    //eemaldame kasutaja sisestusest kahtlase pahna
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));
    //SIIA UUS KONTROLL
    $cool = 'super';
    $kryp = crypt($pass, $cool);
    //kontrollime kas andmebaasis on selline kasutaja ja parool
    $paring = "SELECT * FROM kasutajad WHERE kasutaja='$login' AND parool='$kryp'";

    $valjund = mysqli_query($yhendus, $paring);
    //kui on, siis loome sessiooni ja suuname
    if (mysqli_num_rows($valjund)==1) {
        $_SESSION['kasutaja'] = $login;
        header('Location: kaubaotsing.php');
    } else {
        echo "kasutaja või parool on vale";
    }
}
?>
<h1>Login</h1>
<form action="" method="post">
    <table>
        <tr>
            <td><label for="login">Login</label></td>
            <td><input type="text" name="login" id="login"><br></td>
        </tr>
        <tr>
            <td><label for="pass">Parool</label></td>
            <td><input type="password" name="pass" id="pass"><br></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Logi sisse"></td>
        </tr>
    </table>

</form>