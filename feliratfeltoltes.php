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


$azoldalidje = $_GET["id"];



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Feliratok</title>
    <link rel="stylesheet" type="text/css" href="CSS/feliratfeltoltes.css" />
</head>
<body>
   
<hr>

<div class="div1">

<a href="index.php">Kezdőlap</a>

</div>

<div class="div3">

<a href="adatlapfeltoltes.php">Adatlap feltöltése</a>

</div>

<hr>

<div class = "adatok">

<?php
       foreach ($csvbolkinyertadatok as $kulcs) {
        if ($kulcs[0] == $_GET["id"]){
          //print $kulcs[2];

          print "<img src=" . $kulcs[6] . "><br>";

          print "Eredeti cím japánul: " . $kulcs[1] . "<br />";    

          print "Eredeti cím: " . $kulcs[2] . "<br />";    

          print "Angol cím: " . $kulcs[7] . "<br />";   

          print "Dátum: " . $kulcs[3] . "<br />";   

          print "Részek Száma: " . $kulcs[5] . "<br />";  
          
        }
       }

?>


</div>


<h1> Másik oldalon elérhető felirat linkjének megadása: </h1> <br />


<br>

  <?php
       foreach ($csvbolkinyertadatok as $kulcs) {
        if ($kulcs[0] == $_GET["id"]){
          print $kulcs[2];
        }
    }
  ?> 

  <br>
  <br>
<form action= <?php print "uploadfeliratlink.php?id=" . $azoldalidje ?> method="POST">

  <label for="$feliratkeszito">Felirat készítője:</label><br>
  <input type="text" id="feliratkeszito" name="feliratkeszito" value=""><br>
  <br>
  <label for="$feliratlink">Felirathoz vezető link:</label><br>
  <input type="url" id="feliratlink" name="feliratlink" value=""><br>

  <input type="submit" id="submit" name="submit" value="submit">

</form>
<br />











<h1> Felirat feltöltése </h1> <br />


Anime címe: 

<br>

<?php
       foreach ($csvbolkinyertadatok as $kulcs) {
        if ($kulcs[0] == $_GET["id"]){
          print $kulcs[2];
        }
    }
  
  
  
  
  ?> 

<br>
<br>

<form action= <?php print "upload.php?id=" . $azoldalidje ?> method="post" enctype="multipart/form-data">
  

<label for="feliratkeszito">Felirat készítője:</label><br>
  <input type="text" id="feliratkeszito" name="feliratkeszito" value=""><br>

  <br>

  <label for="quantity">Résztől:</label>
  <input type="number" id="resztol" name="resztol" min="0" >

  <label for="quantity">Részig:</label>
  <input type="number" id="reszig" name="reszig" min="0" > 

  <br>
  <br>

    Feliratfeltöltés: <br>

    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="Feltöltés" name="feltoltessubmit"> <br>

    Kérlek feltöltés előtt "rar" formátumba tömörítsd a feliratot/feliratokat.
</form>



</body>
</html>