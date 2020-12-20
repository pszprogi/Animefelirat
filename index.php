
<?php

function szamlalocsvadatok(){
  $eredmeny = array();
  $file = fopen("CSV/indexlatogatottsag.csv","r");
  while(!feof($file))  {
    $eredmeny[] = fgetcsv($file);
  }
  fclose($file);
  return $eredmeny;
  }
  
$csvszamlalo = szamlalocsvadatok();

$a = $csvszamlalo[0][0];

//print $a;

$a++;
$x = array($a);

session_start(); 
if(!isset($_SESSION['views'])){ 
  $_SESSION['views'] = true;
  $file = fopen("CSV/indexlatogatottsag.csv","w+");
  fputcsv($file, $x);
  fclose($file); 
}


function csvadat(){
    $eredmeny = array();
    $file = fopen("CSV/adatok.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
    }

  

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime Feliratok</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<hr>

<div class="div1">

<a href="adatlapfeltoltes.php">Adatlap feltöltése</a>

</div>

<div class="div3">

<a href="animekeresesfeltolteshez.php">Felirat feltöltése</a>

</div>

<hr>


<div class = "kereso">

Keresés az anime címe alapján

</div>


<form class="example" action="kereso.php" method="post" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Felirat keresés..." name="kereso" id="kereso">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>








<div class = "alphabetical">

<?php 

foreach (range('A', 'Z') as $betu) {
  $betuk = "<a href='animelistak.php?id=" . $betu . "'>" . $betu . "</a>";
    echo $betuk . "\n";
} 

print "<br>";

foreach (range('1', '9') as $szam) {
  $szam = "<a href='animelistak.php?id=" . $szam . "'>" . $szam . "</a>";
    echo $szam . "\n";
} 

?> 

</div>


<div class = "csapatok">

Az oldalon elérhető fordítók, csapatok és feliratlelőhelyek:
<br />
<br />

<a href="https://riczroninfactories.eu/">Ricz/Ronin Factories</a>: 99% (Nekik hatalmas köszönet a segítségért!) <br />
<a href="http://animgo.hu/">AnimGO</a>: 99% <br />
<a href="https://animeraptors.hu/">Anime Raptors</a>: 99% <br />
<a href="https://dragonhall.hu/news.php">DragonHall+</a>: 99% <br />
<a href="http://animeseries.gportal.hu/gindex.php?pg=30415674">Anime Series Hun</a>: 99% <br />
<a href="http://animeweb.hu/">Anime Web</a>: 99% <br />
<a href="https://animeaddicts.hu/news.php?news">Animeaddicts</a>: 0% <br />
<br />
<br />

<h5>Mivel nehéz naprakészen tartani az oldalt, így ha valakinél sikerül is, akkor is csak 99% fog szerepelni.</h5>

</div>









    
</body>
</html>