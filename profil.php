<?php
  require('config.php');
  include('Include/maintain_session.php');

  $invite=$_GET['user'];

  $q='SELECT id from user WHERE nickname=?';
  $req= $bdd->prepare($q);
  $req->execute([$invite]);
  $verif_invite= $req->fetchAll(PDO::FETCH_ASSOC);

  if ($verif_invite[0]['id']==$_SESSION['id']) {
    $verif=1;
  }else {
    $verif=0;
  }

  $id=$verif_invite[0]['id'];
  $q = 'SELECT nickname,name,second_name,country,birth,profile_picture,notif.title,notif.content,file.path,COUNT(subscribe.subscribed) FROM user LEFT JOIN notif ON user.id=notif.id_user INNER JOIN file ON user.profile_picture=file.id INNER JOIN subscribe on subscribe.subscribed=user.id WHERE user.id = ?';
  $req= $bdd->prepare($q);
  $req->execute([$id]);
  $results= $req->fetchAll(PDO::FETCH_ASSOC);

  $q = 'SELECT id FROM post WHERE user_id = ? ';
  $response = $bdd->prepare($q);
  $response->execute([$id]);
  $result2 = $response->fetchAll(PDO::FETCH_ASSOC);

  $q="SELECT post.title,post.view,post.content,post.description,user.nickname,
  file.path,category.name,post.difficulty FROM post LEFT JOIN category ON post.category_id=category.id LEFT JOIN file ON post.id=file.post_id INNER JOIN user ON post.user_id=user.id  WHERE user.id = ? ORDER BY post.dateToday DESC ";

  $req= $bdd->prepare($q);
  $req->execute([$id]);
  $results_post= $req->fetchAll(PDO::FETCH_ASSOC);

  $q ="SELECT category.name,category.id,file.path FROM category INNER JOIN file ON category.img_id=file.id";
  $req = $bdd->query($q);
  $result_cat=$req->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php  if (isset($_COOKIE['theme'])){
              if ($_COOKIE['theme']==0) {
      ?>
      <link rel="stylesheet" type="text/css" href="Style/Style_profil.css">
    <?php }else { ?>
      <link rel="stylesheet" type="text/css" href="Style/Style_profil_black.css">
    <?php  }
    }else{ ?>
      <link rel="stylesheet" type="text/css" href="Style/Style_profil.css">
    <?php  } ?>

  </head>
  <body>

    <?php include('Include/header.php');
    if (isset($_GET['Erreur'])){
      echo '<h1>'.$_GET['msErreurg'].'</h1>';
    }
    ?>

    <main>

      <div class="container">
        <div class="left_div">
          <div class="my_profil">
            <h2>Mon Profil</h2>
          </div>

        <div class="info">

          <div class="img_profil_form">
            <div class="img_profil_button">
              <img  src="<?php echo $results[0]['path'] ?>" alt="Image_profil" height="75px"/>
              <?php if ($verif==1) { ?>
              <label class="litle_input" for="profil_picture">Changer de photo</label>
              </div>
              <form  id='change_picture' enctype="multipart/form-data" action="profil_process.php" method="post">
                <input id='profil_picture' type="file" name="profil_picture" value="" style="display: none">

                <div id='result_picture' class="confirm_picture">
                </div>
              </form>
          </div>

          <?php }
            else { ?>
          <button class="litle_input" onclick="new_convo()">Envoyer un message</button>
          <?php   }  ?>

          <div class="personnal_info_close">
          <?php if ($verif==1) { ?>
          <div class="personnal_info">
          <div id='id_change_info' style="display: none;"><?php echo $id; ?></div>
          <div id='last_name'><p class="left_info">Nom : </p> <p class="right_info"><?php echo $results[0]['second_name']; ?></p></div>
          <div id='first_name'><p class="left_info">Prenom : </p> <p class="right_info"><?php echo $results[0]['name']; ?></p></div>
          <div id='country'><p class="left_info">Pays : </p> <p class="right_info"><?php echo $results[0]['country']; ?></p></div>
          <div id='birth_date'><p class="left_info">Date de naissance : </p> <p class="right_info"><?php echo $results[0]['birth']; ?></p></div>
          <?php } ?>
          <div><p class="left_info">Nombre de post(s) créé(s) : </p> <p class="right_info"><?php echo count($result2); ?></p></div>
          <div><p class="left_info">Nombre d'abonnée(s) : </p> <p class="right_info"><?php echo $results[0]['COUNT(subscribe.subscribed)'] ?></p></div>
          </div>
          <?php if ($verif==1) { ?>
          <div>
            <?php  if (isset($_COOKIE['theme'])){?>
            <form  action="secret_process.php" method="post">
                <input class="litle_input" type="submit" name="submit" value="Changer le thème">
            </form>
          <?php } ?>
          </div>
          <div id='div_close' class="close_account" >
            <div id="choice"></div>
            <button class="litle_input" id='close1' onclick="close_account()">Cloturer le compte</button>
              <form id='form_close' action="close_account_process.php" method="post">
                <input type="hidden" name="user_id" value=<?php echo $id; ?>>
              </form>
              <div id='cancel'></div>
              </div>
          <?php } ?>
        </div>
        </div>
      </div>

    <div class="right_div">
      <div class="pseudo" id='pseudo1' >
        <h1 id='pseudo2'> <?php echo $results[0]['nickname']; ?></h1>

        <?php if ($verif==1) { ?>
        <button id='modif1' onclick="modif_profil()">Changer de pseudo</button>
        <?php } ?>
        <div class="result_change_pseudo" id='pseudo3'>

        </div>
      </div>
      <div class="post">
        <p>Posts</p>
        <div class="post_div">
          <?php foreach ($results_post as $key => $value) {
            $content = substr($results_post[$key]['content'],0,30);
            ?>
            <div>
              <div>
                <img class="img_post" src='<?php

  							if($results_post[$key]['path'] === null){
  								foreach ($result_cat as $key2 => $value2) {

  									if($result_cat[$key2]['name'] === $results_post[$key]["name"]){
  										echo $result_cat[$key2]['path'];
  									}
  								}
  							}
  							else{
  								echo $results_post[$key]["path"];
  							}?>' />
              </div>
              <div>
                <h1><?php echo  $results_post[$key]['title']; ?></h1>
                <p>Description : <?php echo  $results_post[$key]['description']; ?></p>
                <p>Créer par : <strong><?php echo  $results_post[$key]['nickname']; ?></strong></p>
                <ul class="cat_list">
                  <li><?php echo  $results_post[$key]['name']; ?></li>

                </ul>
              </div>
              <div>
                <p style="align-self:flex-end">Vues : <?php echo  $results_post[$key]['view']; ?></p>
                <div class="right_post">


                <ul class="star_list">
                   <?php
                   for ($i=0; $i <$results_post[$key]['difficulty'] ; $i++) {
                    echo "<img class='mini-star' src='Images/icons8-étoile-64.png' />";
                   } ?>

                </ul>
                  <a href="page.php?title=<?php echo  $results_post[$key]['title']; ?>">C'est Tipar !</a>
                  </div>
            </div>

            </div>
            <?php } ?>
            </div>
          </div>
        </div>

      </div>

      </main>
      <div id="id_user_mess" style="display:none;"><?php echo $verif_invite[0]['id'] ?></div>
    <script src="js/profil.js"></script>
    <script src="js/start_convo.js">

    </script>
  </body>
</html>
