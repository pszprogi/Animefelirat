<?php


function csvfajlmegnyitasolvasashoz(){      // innen szedi ki az ID-t.  
    $eredmeny = array();
    $file = fopen("CSV/adatok.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
    }

$csvbolkinyertadatok = csvfajlmegnyitasolvasashoz();


    foreach ($csvbolkinyertadatok as $vegigitteralasazangolcimert){
      if ($vegigitteralasazangolcimert[0] == $_GET["id"]){
        $azanimecimeangolul = $vegigitteralasazangolcimert[2];
      }
    }
   






$ellenorzes2 = FALSE;                   //ellenőrzi, hogy szerepel e már a feliratlink
if (isset($_POST["feliratlink"])){
if (($feliratlinkek = fopen('CSV/feliratlinkek.csv', 'r')) !== FALSE) { 
  while (($ellenorzes = fgetcsv($feliratlinkek, 10000, ",")) !== FALSE) { 
      if($ellenorzes[2] == $_POST["feliratlink"]){
        $ellenorzes2 = TRUE;
      } 
  }
  fclose($feliratlinkek);
}
}



//if(isset($_POST['submit'])){          //Csak a submit után engedi lefutni
  $valaszuzenet = feliratfeltoltes($ellenorzes2, $azanimecimeangolul );
//} 


function feliratfeltoltes($ellenorzes2, $azanimecimeangolul){
  if ($_POST["feliratkeszito"] == null or $_POST["feliratlink"] == null) {
    return 3;
  } 
  if ($ellenorzes2 == TRUE){
    return 1;  
  }  
  $file = fopen("CSV/feliratlinkek.csv","a+");
  $tablazatiras = array($_GET["id"], $_POST["feliratkeszito"], $_POST["feliratlink"], $azanimecimeangolul );
    fputcsv($file, $tablazatiras);
    fclose($file);
    return 2;
  }
 



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
    

<?php
if($valaszuzenet == 1){
  print "Köszönöm a feltöltést, de ez már fel lett töltve";
} elseif ($valaszuzenet == 2){
  print "Köszönöm a feltöltést!";
} elseif ($valaszuzenet == 3){
  print "Kérlek minden mezőt tölts ki!";
}

?>














</body>
</html>