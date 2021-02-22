<?php
  session_start();
  if (isset($_SESSION['id'])){
  header("location: index.php?msg=Vous êtes identifié pas besoin d'aller sur cette page");
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="Style/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="Style/Style_header.css">
  </head>
  <body>
      <?php include('Include/header.php'); ?>

      <div class="ErrorMsg">
      <?php
      if (isset($_GET['msg'])){
        echo '<h1>'.$_GET['msg'].'</h1>';
      }
      ?>
      </div>
      <div class="center">
          <section class="flexSection">
            <h1>Inscription</h1>
            <p>Vous ne possédez toujours pas de compte chez nous ?</p>
            <p>Créez-vous en un en cliquant sur le bouton ci-dessous</p>
            <a href="signup.php"><button class="btn colorYellow">S'inscrire</button></a>
          </section>
          <div class="line">

          </div>
          <section>
            <h1>Connexion</h1>
            <form  action="signin_process.php" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Pseudo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pseudo" placeholder="Pseudo">
                <small id="emailHelp" class="form-text text-muted">Entrez votre pseudo pour vous connecter</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mot De Passe</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Mot De Passe">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="sess">
                <label class="form-check-label" for="exampleCheck1">Rester Connecté</label>
              </div>
              <button type="submit" name="submit" class="btn colorYellow">Se connecter</button>

            </form>
          </section>
      </div>
  </body>
</html>
