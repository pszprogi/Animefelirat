
<?php

// KÖZÖS

function animeadatokcsv(){
  $eredmeny = array();
  $file = fopen("CSV/adatok.csv","r");
  while(!feof($file))  {
    $eredmeny[] = fgetcsv($file);
  }
  fclose($file);
  return $eredmeny;
  }
  
  $angolcimek = animeadatokcsv();


  foreach ($angolcimek as $vegigitteralasazangolcimert){
    if ($vegigitteralasazangolcimert[0] == $_GET["id"]){
      $azanimecimeangolul = $vegigitteralasazangolcimert[2];
    }
  }
 

 $azanimeangolneveatalakitvafajnevnek = str_replace(" ", ".", (preg_replace('/[^A-Za-z0-9\-]/', "", $azanimecimeangolul)));

 

$ujnev = $azanimeangolneveatalakitvafajnevnek . "-" . $_POST["feliratkeszito"] . "-" . $_POST["resztol"] . "-" . $_POST["reszig"] . ".rar";

$fajlnev = basename($_FILES["fileToUpload"]["name"]);

$mappaNev = "./Feltoltes/" . $azanimeangolneveatalakitvafajnevnek . "/";





// ADATOK TÁBLÁZATBA MENTÉSE

$ellenorzes2 = FALSE;                   //ellenőrzi, hogy szerepel e már a feliratlink
if (isset($_POST["feltoltessubmit"])){
if (($feltoltottFelirat = fopen('CSV/feltoltottfelirat.csv', 'r')) !== FALSE) { 
  while (($ellenorzes = fgetcsv($feltoltottFelirat, 100000, ",")) !== FALSE) { 
      if($ellenorzes[4] == $ujnev){
        $ellenorzes2 = TRUE;
      } 
  }
  fclose($feltoltottFelirat);
}
}


if(isset($_POST['feltoltessubmit']) && isset($_POST['feliratkeszito']) && isset($_POST['resztol']) && isset($_POST['reszig'])){         //Csak a submit után engedi lefutni
  feliratfeltoltes($ellenorzes2, $ujnev, $fajlnev, $mappaNev, $azanimecimeangolul );
} 


function feliratfeltoltes($ellenorzes2, $ujnev, $fajlnev, $mappaNev, $azanimecimeangolul  ){
  if ($ellenorzes2 == TRUE){
    return;  
  }  
  $file = fopen("CSV/feltoltottfelirat.csv","a+");
  $tablazatiras = array($_GET["id"], $_POST["resztol"], $_POST["reszig"],$_POST["feliratkeszito"], $ujnev, $fajlnev, $mappaNev, $azanimecimeangolul );
    fputcsv($file, $tablazatiras);
  
    fclose($file);
}





// FELTÖLTÉS

$ujFajlEleresiUtja = $_FILES["fileToUpload"]["tmp_name"];

$felToltottFajlMerete = filesize($ujFajlEleresiUtja)/1024;

$valszuzenet = 0;
if($_POST['feltoltessubmit'] == null or $_GET['id'] == null or $_POST['feliratkeszito'] == null or $_POST['resztol'] == null or $_POST['reszig'] == null){          //Csak a submit után engedi lefutni
  $valszuzenet = 3;
} else {
  $valszuzenet = feliratFajlFeltoltes($mappaNev, $ujnev, $ujFajlEleresiUtja, $felToltottFajlMerete );
}


function feliratFajlFeltoltes($mappaNev, $ujnev, $ujFajlEleresiUtja, $felToltottFajlMerete){
  if ($felToltottFajlMerete < "5500"){
  if (file_exists($mappaNev)) {
    if(file_exists($mappaNev . "/" . $ujnev)){
      return 1;
    } else { 
      move_uploaded_file($ujFajlEleresiUtja, $mappaNev . $ujnev);
      return 2;
    }
  }
  if (!file_exists($mappaNev) && $felToltottFajlMerete < "2500") {
    mkdir($mappaNev);
    move_uploaded_file($ujFajlEleresiUtja, $mappaNev . $ujnev);
      return 2;
    }
  } else {
    print "Túl nagy méretű fájl!";
  }
}




//   move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], mkdir("./Feltoltes/" . $_POST["angolcim"]) . "/" . $fajlnev)

// if(isset($_POST['submit'])){
//     if(!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], mkdir("./Feltoltes/" . $_POST["angolcim"]) . "/" . $fajlnev)) {
//     }
//   } 


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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


<?php
if($valszuzenet == 1){
  print "Köszönöm a feltöltést, de ez már fel lett töltve";
} elseif ($valszuzenet == 2){
  print "Köszönöm a feltöltést!";
} elseif ($valszuzenet == 3){
  print "Kérlek minden mezőt tölts ki!";
}

?>



</body>
</html>