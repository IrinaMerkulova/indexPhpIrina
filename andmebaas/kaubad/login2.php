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
    $krypt = crypt($pass, $cool);
    //kontrollime kas andmebaasis on selline kasutaja ja parool
    $paring=$yhendus->prepare("SELECT kasutaja, parool, onAdmin FROM kasutajad WHERE kasutaja=? AND parool=?");
    $paring->bind_param("ss", $login, $krypt);
    $paring->bind_result($kasutaja, $parool, $onAdmin);
    $paring->execute();
    // if onadmin==1 ?
    //$valjund = mysqli_query($yhendus, $paring);
    //kui on, siis loome sessiooni ja suuname
    if ($paring->fetch() && $parool=$krypt) {
        $_SESSION['kasutaja'] = $login;
        if($onAdmin==1){
            $_SESSION['admin'] = true;

        }
        header('Location: kaubaotsing.php');
        $yhendus->close();
    } else {
        echo "kasutaja või parool on vale";
        $yhendus->close();
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