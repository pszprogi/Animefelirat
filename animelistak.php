
<?php


function csvadat(){
    $eredmeny = array();
    $file = fopen("CSV/adatok.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
    }

$csvbolkinyertadatok = csvadat();
 






// ELLENŐRZI, HOGY A KERESŐSZÓ MEGTALÁLHATÓ E A FELIRATLINKEK KÖZÖTT


function feliratlinkekellenorzesecsvben(){       
  $eredmeny = array();
  $file = fopen("CSV/feliratlinkek.csv","r");
  while(!feof($file))  {
    $eredmeny[] = fgetcsv($file);
  }
  fclose($file);
  return $eredmeny;
  }

$feliratlinkellenorzes = feliratlinkekellenorzesecsvben();


$letezikhozzalink = array();
foreach($feliratlinkellenorzes as $feliratlinkeknelazangolcim){
  $aktualisnangolcimafeliratlinkeknel = strtolower($feliratlinkeknelazangolcim[3]);
    if (substr($aktualisnangolcimafeliratlinkeknel,0,1) == strtolower($_GET["id"])){
      $letezikhozzalink[strtolower($feliratlinkeknelazangolcim[3])][] = true;
    }
}




// ELLENŐRZI, HOGY A KERESŐSZÓ MEGTALÁLHATÓ E A FELTÖLTÖTT FELIRATOK KÖZÖTT


function feltoltottfeliratellenorzésecsvben(){      
      $eredmeny = array();
      $file = fopen("CSV/feltoltottfelirat.csv","r");
      while(!feof($file))  {
        $eredmeny[] = fgetcsv($file);
      }
      fclose($file);
      return $eredmeny;
      }

$feltoltottfeliratellenorzes = feltoltottfeliratellenorzésecsvben();


$letezikhozzafelirat = array();
foreach($feltoltottfeliratellenorzes as $feltoltottfeliratangolcim){
  $aktualisnangolcimafeliratfeltoltesben = strtolower($feltoltottfeliratangolcim[7]);
    if (substr($aktualisnangolcimafeliratfeltoltesben,0,1) == strtolower($_GET["id"])){
    // if (strpos($aktualisnangolcimafeliratfeltoltesben, $kereses) !== false){
      $letezikhozzafelirat[strtolower($feltoltottfeliratangolcim[7])][] = true;
    }
}




$csakAzoknakazAnimeknekaCimeiAmiketMegKellJeleniteni = array_merge($letezikhozzalink,$letezikhozzafelirat);







?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Feliratok</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
</head>
<body>
    
<hr>

<div class="div1">

<a href="index.php">Kezdőlap</a>

</div>

<div class="div2">

<a href="adatlapfeltoltes.php">Adatlap feltöltése</a>

</div>

<div class="div3">

<a href="animekeresesfeltolteshez.php">Felirat feltöltése</a>

</div>

<hr>




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



<div class="animelista">

<?php

// foreach (csvadat() as $kulcs) {
//     if (substr($kulcs[2],0,1) == $_GET["id"]){
      foreach ($csvbolkinyertadatok as $csvbenlevosorok){
        foreach($csakAzoknakazAnimeknekaCimeiAmiketMegKellJeleniteni as $angolcimekAmikhezVanFelirat => $nemFontos){
             if (strtolower($csvbenlevosorok[2]) == $angolcimekAmikhezVanFelirat){
              print "<a href='adatlap.php?id=" . $csvbenlevosorok[0] . "'><img src='" . $csvbenlevosorok[6] . "' border='0'></a><br>";
              print "<a href='adatlap.php?id=" . $csvbenlevosorok[0] . "'>" . $csvbenlevosorok[2] . "</a><br>";
              print "(" . $csvbenlevosorok[3] . ")<br>";
              print "<br>";
          }
        }
      }






?>


</div>
















</body>
</html>