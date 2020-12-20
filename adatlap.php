<?php

// KÖZÖS

function csvbolAnimeAdatKinyerés($csvadat){
    //$sorszam = null;
    foreach ($csvadat as $sorszam => $sor){
        if ($sor[0] == $_GET["id"]) {
            return $sor;
        }
    }
}



// AZ ANIME ADATAI

function animeadatokcsv(){
    $eredmeny = array();
    $file = fopen("CSV/adatok.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
    }

$animeAdatok= animeadatokcsv();

$beirandoAnimeAdatok = csvbolAnimeAdatKinyerés($animeAdatok);



// A FELIRAT LINKEK ADATAI


function feliratlinkcsv(){
    $eredmeny = array();
    $file = fopen("CSV/feliratlinkek.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
}


$feliratlink = feliratlinkcsv();

$animeAzonositasaFeliratLinkhez = csvbolAnimeAdatKinyerés($feliratlink);


// A LETÖLTHETŐ FELIRAT ADATAI

function feltoltottfeliratcsvben(){
    $eredmeny = array();
    $file = fopen("CSV/feltoltottfelirat.csv","r");
    while(!feof($file))  {
      $eredmeny[] = fgetcsv($file);
    }
    fclose($file);
    return $eredmeny;
}


$feltoltottFelirat = feltoltottfeliratcsvben();
$animeAzonositasaLetolteshez = csvbolAnimeAdatKinyerés($feltoltottFelirat);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime feliratok</title>
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





<h1> Eredeti cím japánul: <?php  print $beirandoAnimeAdatok[1];  ?> </h1> 

<h1> Eredeti cím: <?php  print $beirandoAnimeAdatok[2];  ?> </h1> 

<h1> Angol cím: <?php  print $beirandoAnimeAdatok[7];  ?> </h1>

<h1> Dátum: <?php  print $beirandoAnimeAdatok[3];  ?> </h1>

<h1> Részek Száma: <?php  print $beirandoAnimeAdatok[5];  ?> </h1>

<br>



<?php

if ($animeAzonositasaFeliratLinkhez[0] == $_GET["id"]){
    print "<h1> A felirat elérhető a következő fordítóknál:<h1>"; 
    foreach ($feliratlink as $sorszam => $beirandoLinkAdatok){
        if ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "https://animeaddicts.hu/file/sub.php?cat"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Animeaddictsra régen feltöltött</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "https://animeaddicts.hu/project.php"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Animeaddicts</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "dragonhall"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Dragonhall+</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "ricz"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Ricz/Ronin Factories oldalon elérhető feliratok</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "animeweb"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Anime Web</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "animgo"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">AnimGO</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "raptors"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Anime Raptors</a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"] && (stristr($beirandoLinkAdatok[2], "animeseries"))){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Anime Series HUN </a><br>";
        }
        elseif ($beirandoLinkAdatok[0] == $_GET["id"]){ 
            print "<a href=" . $beirandoLinkAdatok[2] . ">Link</a><br>";
        }
    } 
}



?>

<?php
    //Feliratosak:
?>    

<h1>

<br>

<?php 




if ($animeAzonositasaLetolteshez[0] == $_GET["id"]){
    foreach ($feltoltottFelirat as $sorszam => $beirandoLetolthetoFeliratAdatok){
        if ($beirandoLetolthetoFeliratAdatok[1] === "1" && $beirandoLetolthetoFeliratAdatok[2] === "1" && $beirandoLetolthetoFeliratAdatok[0] == $_GET["id"] && $beirandoAnimeAdatok[5] === "1"){
        Print "Felirat letöltése:" . "<br>";
        print "<br>";    
        print "Fordító: " . $beirandoLetolthetoFeliratAdatok[3] . "<br>";
        print "<a href=" . $beirandoLetolthetoFeliratAdatok[6] . $beirandoLetolthetoFeliratAdatok[4] . ">Teljes felirat</a></p>";
        }
    }
    if ($animeAzonositasaLetolteshez[0] == $_GET["id"] && $animeAzonositasaLetolteshez[2] > "1"){           
        $forditok = array();
        foreach ($feltoltottFelirat as $sorszam => $csv_sor){ 
            if($csv_sor[0] == $_GET["id"]) {
                $nev = $csv_sor[3];
                $forditok[$nev][] = $csv_sor;
            }
        } 
        foreach ($forditok as $forditoNeve => $feliratNeve ){
            Print "Felirat letöltése:" . "<br>";
            print "<br>"; 
            print "Fordította: " . $forditoNeve . "<br>";
            foreach ($feliratNeve as $nemfontos => $feltoltottFeliratAdatok){
            print "<a href=" . $feltoltottFeliratAdatok[6] . $feltoltottFeliratAdatok[4] . ">" . $feltoltottFeliratAdatok[1] . " - " . $feltoltottFeliratAdatok[2] . ". rész</a><br>";
            "<br>";
            }
            "<br>";
        }    

    }
    
}  


//&& $animeAzonositasaLetolteshez[2] > "1"



?>

</h1>





</body>
</html>