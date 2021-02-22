<?php
require('config.php');
include('Include/maintain_session.php');



$q ="SELECT name,id FROM category";
$req = $bdd->query($q);
$result_cat=$req->fetchAll(PDO::FETCH_ASSOC);
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>New Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Desciption" content="Page de création de poste">
    <?php  if (isset($_COOKIE['theme'])){
              if ($_COOKIE['theme']==0) {
      ?>
      <link rel="stylesheet" type="text/css" href="Style/Style1.css">
    <?php }else { ?>
      <link rel="stylesheet" type="text/css" href="Style/Style1_black.css">
    <?php  }
    }else{ ?>
      <link rel="stylesheet" type="text/css" href="Style/Style1.css">
    <?php  } ?>
  </head>
  <body>

    <?php include('Include/header.php');
    if (!(isset($_SESSION['id']))){
  		echo ("	<p>Connectez vous pour créé votre post</p>");

  	}else {

  		if(isset($_GET['Erreur'])){
  			echo '<p>'.$_GET['Erreur'].'</p>';
  		}
  	include('Include/navbar.php'); ?>

<main>

<div class="left_div">
  <div class="title_page">
    <h1>Création de poste</h1>
    <small>Créez vôtre poste ici !</small>

  </div>
  <div class="post_crea">

    <input type="text" id="title" name="title" placeholder="Rentrez votre titre">
    <input type="text" id="description" name="text" placeholder="Rentrez votre Description">
    <select id="category" class="category_selector">
      <?php foreach ($result_cat as $key => $value) {?>
        <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
    <?php  } ?>

    </select>

  </div>


  <div id="crea">

  </div>
  <div class="post_crea">
    <button onclick="create_div()">Zone Text</button>
    <button onclick="create_img()">Zone Image</button>
    <div class="star_selector">
      <img name="1" class="star unactive" src="Images/icons8-étoile-64.png" onclick="star(this)"/><img class="star unactive" src="Images/icons8-étoile-64.png" onclick="star(this)" name="2"/><img name="3" class="star unactive" src="Images/icons8-étoile-64.png" onclick="star(this)"/><img  name="4" class="star unactive" src="Images/icons8-étoile-64.png" onclick="star(this)"/><img  name="5" class="star unactive" src="Images/icons8-étoile-64.png" onclick="star(this)"/>
    </div>
    <div>
      <button onclick="create_str()">FINI</button>
    </div>
  </div>

</div>
<div class="right_div">



</div>
</main>
</div>





  </div>




    <?php } ?>



    <script src="js/post.js"charset="utf-8"></script>
    <script src="new_post.js" charset="utf-8"></script>
  </body>
</html>
