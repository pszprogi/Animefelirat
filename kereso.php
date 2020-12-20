
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



$kereses = strtolower($_POST["kereso"]);



//$letezikhozzaadat = array();
foreach($csvbolkinyertadatok as $csvbolkinyertadatoksor){
  if( strpos(strtolower($csvbolkinyertadatoksor[1]), $kereses) !== false or strpos(strtolower($csvbolkinyertadatoksor[2]), $kereses) !== false or strpos(strtolower($csvbolkinyertadatoksor[7]), $kereses) !== false ){
  $letezikhozzaadat[] = array($csvbolkinyertadatoksor[0]);
  }
}




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
foreach($feliratlinkellenorzes as $feliratlinkeksor){
  foreach ($letezikhozzaadat as $letezikhozzaadatsor){
   if ($feliratlinkeksor[0] == $letezikhozzaadatsor[0]){
      $letezikhozzalink[] = $feliratlinkeksor[0];
    }
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
  foreach ($letezikhozzaadat as $letezikhozzaadatsor){
    if ($feltoltottfeliratangolcim[0] == $letezikhozzaadatsor[0]){
      $letezikhozzafelirat[] = $feltoltottfeliratangolcim[0];
    }
  }
}



$csakAzoknakazAnimeknekaCimeiAmiketMegKellJeleniteni = array_unique( array_merge($letezikhozzalink,$letezikhozzafelirat) );



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Feliratok</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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




<div class = "kereso">

Keresés az anime címe alapján

</div>


<form class="example" action="kereso.php" method="post" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Felirat keresés..." name="kereso" id="kereso">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>






<div class="animelista">

<?php




foreach ($csvbolkinyertadatok as $csvbenlevosorok){
  foreach($csakAzoknakazAnimeknekaCimeiAmiketMegKellJeleniteni as $talalthozzafeliratot){
        if ($csvbenlevosorok[0] == $talalthozzafeliratot){
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