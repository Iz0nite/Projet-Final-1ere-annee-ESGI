<?php
require('config.php');
include('Include/maintain_session.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style/Style1.css">
    <link rel="stylesheet" type="text/css" href="Style/Style_secret.css">
    <link rel="stylesheet" type="text/css" href="Style/Style_header.css" />
    <title></title>
  </head>
  <body>
    <?php
          include('Include/header.php');
     ?>
    <main>
      <div class="container_secret">

        <p>Félécitation vous avez découvert la partie cachée de notre site en récompense de vos efforts nous vous offrons les 4 vidéos qui illustrent l'avancer de la réalisation de ce site ainsi qu'une récompense supplémentaire en cliquant sur le bouton ci-dessous.</p>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/An0e4QuOgg0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/0s3KjU5I5UE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ERHIB2RhDqA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/WhZkjDg0i8g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <form action="secret_process.php" method="post">
            <input class="litle_input" type="submit" name="submit" value="cornichon">
        </form>

      </div>
    </main>
  </body>
</html>
