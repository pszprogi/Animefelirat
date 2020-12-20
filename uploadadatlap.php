<?php


//KÖZÖS

function csvfajlmegnyitasolvasashoz(){      // kinyeri az adatok csv-ben lévő adatokat  
    $eredmeny = array();
    $file = fopen("CSV/adatok.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
    }
$csvbolkinyertadatok = csvfajlmegnyitasolvasashoz();


function sorszam () {
  $sorSzam = count(file("CSV/adatok.csv"));
  $sorSzam++;
  return $sorSzam;
}


$azanimeangolcime = $_POST["angolcim"];


$azanimeangolneveatalakitvafajnevnek = str_replace(" ", ".", (preg_replace('/[^A-Za-z0-9\-]/', "", $azanimeangolcime)));

 
$KepUjNeve = $azanimeangolneveatalakitvafajnevnek . "-" . $_GET["id"] . ".jpg";
  

$fajlnev = basename($_FILES["kepfeltoltes"]["name"]);
  

$mappaNev = "./Kepek/" . "/";


$ujFajlEleresiUtja = $_FILES["kepfeltoltes"]["tmp_name"];


$kepmeret = getimagesize($ujFajlEleresiUtja);
$kepSzelessege = $kepmeret[0];
$kepMagassaga = $kepmeret[1];






// print $kepSzelessege;
// print $kepMagassaga;



$feltoltottKepEleresiHelye = $mappaNev . $KepUjNeve;


$felToltottFajlMerete = filesize($ujFajlEleresiUtja)/1024;


        //ITT ELLENŐRZI HOGY MEHET E A FELTOLTES
        $valaszuzenet = 9999;
        $feltolthetoE = false;
foreach ($csvbolkinyertadatok as $a){
  if (strtolower($a[1]) == strtolower($_POST["eredeticimjapanul"]) or strtolower($a[2]) == strtolower($_POST["angolcim"]) or strtolower($a[4]) == strtolower($_POST["masikoldallink"])){
      $valaszuzenet = 1;
      break;
  } 
}

if($valaszuzenet != 1) {
  if ($felToltottFajlMerete > 1024){
    $valaszuzenet = 2;
  }
  else if (!isset($_POST["eredeticimjapanul"]) or !isset($_POST["angolcim"])){
    $valaszuzenet = 3;
  }
  else if ($kepSzelessege > 250 or $kepMagassaga >370){
    $valaszuzenet = 5;
  }
  else {
    $feltolthetoE = true;
    $valaszuzenet = 4;
  }
}

if($feltolthetoE == true){
    adatokmentesecsvbe($feltoltottKepEleresiHelye );
    feliratFajlFeltoltes($mappaNev, $KepUjNeve, $ujFajlEleresiUtja );
}

function kapitalizalas($szoveg) {
    return ucwords(($szoveg));
  }


            // EZZEL MENTI EL AZ ADATOKAT A CSV-BE
function adatokmentesecsvbe($feltoltottKepEleresiHelye ){
    $file = fopen("CSV/adatok.csv","a+");
          $angolcim = kapitalizalas($_POST["angolcim"]); 
          $tablazatiras = array($_GET["id"], $_POST["eredeticimjapanul"], $angolcim, $_POST["datum"], $_POST["masikoldallink"], $_POST["reszekSzama"], $feltoltottKepEleresiHelye, $_POST["eredeticimatirva"]);
          fputcsv($file, $tablazatiras);
          
}


            //EZZEL MENTI LE A KÉPET
function feliratFajlFeltoltes($mappaNev, $KepUjNeve, $ujFajlEleresiUtja ){
  if (file_exists($mappaNev)) {
    if(file_exists($mappaNev . "/" . $KepUjNeve)){
      return;
    } else { 
      move_uploaded_file($ujFajlEleresiUtja, $mappaNev . $KepUjNeve);
      return;
    }
  }  
  if (!file_exists($mappaNev)) {
    mkdir($mappaNev);
    move_uploaded_file($ujFajlEleresiUtja, $mappaNev . $KepUjNeve);
      return;
  }
}











?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Felirat</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
</head>
<body>
    
</body>
</html>


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



<?php

if($valaszuzenet == 1){
    print "Már létezik az anime";
}
if($valaszuzenet == 2){
    print "Túl nagy a képfájl mérete, maximum 1MB méretű tölthető fel.";
}
if($valaszuzenet == 3){
    print "Kérlek minden mezőt tölts ki";
}
if($valaszuzenet == 4){
    print "Köszönöm a feltöltést!";
}
if($valaszuzenet == 5){
  print "Túl nagy méretű a kép, a maximálisan feltölthető méret: 250 x 350 px.";
}





?>