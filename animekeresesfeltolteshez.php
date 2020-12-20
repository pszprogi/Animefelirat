
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

if (isset($_POST["kereso"])){
    $kereses = strtolower($_POST["kereso"]);

}
























?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Feliratok</title>
    <link rel="stylesheet" type="text/css" href="CSS/animekeresesfeltolteshez.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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


</div>

<div class="div4">

Anime keresése:

</div>



<div class="divkereso">


<form class="example" action="animekeresesfeltolteshez.php" method="post" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Anime keresése..." name="kereso" id="kereso">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>


</div>


<div class="animelista">


<?php

if (isset($_POST["kereso"])){
    foreach ($csvbolkinyertadatok as $csvbenlevosorok){
        //print_r($csvbenlevosorok[2]);
        $aktualisangolcim1 = strtolower($csvbenlevosorok[1]);   //JAPÁN CÍM EREDETIBEN
        $aktualisangolcim2 = strtolower($csvbenlevosorok[2]);   //JAPÁN CÍM ÁTÍRVA
        $aktualisangolcim7 = strtolower($csvbenlevosorok[7]);   //ANGOL CÍM
        if((strpos($aktualisangolcim2, $kereses)!== false) or strpos($aktualisangolcim7, $kereses)!== false or strpos($aktualisangolcim1, $kereses)!== false){
            print "<a href= 'feliratfeltoltes.php?id=" . $csvbenlevosorok[0] . "'><img src='" . $csvbenlevosorok[6] . "' border='0'></a><br>";
            print "<a href='feliratfeltoltes.php?id=" . $csvbenlevosorok[0] . "'>" . $csvbenlevosorok[2] . "</a><br>";
            print "(" . $csvbenlevosorok[3] . ")<br>";
            print "<br>";
        } 
    }
}

?>

</div>









</body>
</html>