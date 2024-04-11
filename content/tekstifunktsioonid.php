<?php
// eemalda urlist muutujad
function clearVarsExcept($url, $varname) {
    return strtok(basename($_SERVER['REQUEST_URI']),"?")."?$varname=".$_REQUEST[$varname];
}

$tekst='Aprill on kevad';

echo $tekst;
echo "<br>";
echo "<section>";
echo "<h2>Kasutame teksti funktsioonid</h2>";
echo "<div>";
// Kõik tähed on väikesed
echo strtolower($tekst);
echo "<br>";
// Kõik tähed on suured
echo strtoupper($tekst);
echo "<br>";

//Iga sõna algab suure tähega
echo ucwords(strtolower($tekst));
echo "<br>";

//teksti pikkus
echo 'Antud teksti pikkus: '.strlen($tekst);
echo "<br>";

//sõnade arv tekstis
echo 'Antud teksti sõnade arv: '.str_word_count($tekst);
echo "<br>";

//otsime $otsing asukoht
$otsing='on';
echo strpos($tekst,$otsing);
echo "<br>";
//eraldame esimesed 4 tähte
echo substr($tekst, 0, 4); //Apri
echo "<br>";
// выделить все слова начиная с on - on kevad
echo substr($tekst, strpos($tekst,$otsing), strlen($tekst)-strpos($tekst,$otsing));

echo "</div>";
echo "</section>";
echo "<section>";
echo "<h2>Kasutame veebis leitud näidised</h2>";
echo 'https://www.metshein.com/unit/php-tekstifunktsioonid-ulesanne-9/';
echo "<div>";
// teksti kärpimine
$tekst2 = ' 	A woman should soften but not weaken a man   ';
echo "<pre>$tekst2</pre>";
// trim-? -kustutab tühikud
echo "<pre>".trim($tekst2)."</pre>";
//ltrim -?
echo "<pre>".ltrim($tekst2)."</pre>";
//rtrim -?
echo "<pre>".rtrim($tekst2)."</pre>";

echo "<br>"; //kustutakse A, a, k..n, w
$tekst3 = 'A woman should soften but not weaken a man';
echo trim($tekst3, "A, a, k..n, w");	//oman should soften but not weake
echo '<br>';
//tekst kui massiiv
$tekst = 'All thinking men are atheists';
echo $tekst[0]; //esimene täht
echo '<br>';
echo $tekst[4]; // viies täht
echo '<br>';

echo substr($tekst, 3, 5);		//thin
echo '<br>';
//-13 ? arvutakse lõpust alguseni
echo substr($tekst, 4, -13);	//thinking men
echo '<br>';
echo substr($tekst, -8, 7);		//atheist
echo '<br>';
// str_word_count($tekst, 1); 1- sõnad pannakse massivi
$sona = str_word_count($tekst, 1);
echo $sona[2]; //men
echo '<br>';
//2 esimese tähe index
print_r(str_word_count($tekst, 2));
//Array ( [0] => All [4] => thinking [13] => men [17] => are [21] => atheists )

echo "</div>";
echo "<h2>Teksti asendamine</h2>";
echo "<div>";
$tekst = 'Pai papa, pane paadile punased purjed peale';
$asendus = 'emme'; // чем заменить
$otsitav_algus = 4; // начальный символ
$otsitav_pikkus = 4; // всего замен-символов
echo substr_replace($tekst, $asendus, $otsitav_algus, $otsitav_pikkus);

echo '<br>';
$tekst = 'Musta lehma saba musta lehma taga, valge lehma saba valge lehma taga';
echo $tekst;
echo '<br>';
$otsi = 'lehm';
$asenda = 'koer';
echo str_replace($otsi, $asenda, $tekst);
echo "</div>";
echo "</section>";
echo "<section>";
echo "<h2>Mõistatus. ........</h2>";
// 6 подсказок (выводить списком) при помощи разных функции.
$tttt='tark';

echo "</section>";
?>
<form name="kontroll" method="post" action="<?=clearVarsExcept(basename($_SERVER['REQUEST_URI']),"veebileht")?>">
<label for="kontrollsyna">Sisesta sõna:</label>
    <input type="text" name="kontrollsyna" id="kontrollsyna">
    <input type="submit" value="Kontrolli">
</form>
<?php
if(isset($_REQUEST["kontrollsyna"])){
    if($_REQUEST["kontrollsyna"]==$tttt){
        echo "<body style='background-color:lightgreen;'>";
    } else {
        echo "<body style='background-color:red;'>";
    }
}
?>

