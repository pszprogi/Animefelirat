<?php


function sorszam () {
  $sorSzam = count(file("CSV/adatok.csv"));
  $sorSzam++;
  return $sorSzam;
}

$azUjAnimeIDje = sorszam()



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

<div class="div3">

<a href="animekeresesfeltolteshez.php">Felirat feltöltése</a>

</div>

<hr>





<h1> Adatlap feltöltése </h1> <br />

<form action= <?php print "uploadadatlap.php?id=" . $azUjAnimeIDje ?> method="POST" enctype="multipart/form-data">

  <label for="eredeticimjapanul">Eredeti cím japánul:</label><br>
  <input type="text" id="eredeticimjapanul" name="eredeticimjapanul" value=""><br>

  <br>

  <label for="eredeticimatirva">Eredeti cím átírva:</label><br>
  <input type="text" id="eredeticimatirva" name="eredeticimatirva" value=""><br>

  <br>

  <label for="$angolcim">Angol cím:</label><br>
  <input type="text" id="angolcim" name="angolcim" value=""><br>

  <br>

  <input type="file" name="kepfeltoltes" id="kepfeltoltes"><br>

  <br>

  <label for="$datum">Dátum:</label><br>
  <input type="text" id="datum" name="datum" value=""><br>

  <br>

  <label for="$masikoldallink">Külsős oldal linkje:</label><br>
  <input type="text" id="masikoldallink" name="masikoldallink" value=""><br>

  <br>

  <label for="$reszekSzama">Részek Száma:</label><br>
  <input type="number" id="reszekSzama" name="reszekSzama" value=""><br>

  <br>

   <input type="submit" id="submit" name="submit" value="Submit">
</form>
<br />





 














</body>
</html>