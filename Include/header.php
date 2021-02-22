<?php
if (isset($_SESSION['id'])) {
  $id=$_SESSION['id'];

  $q = 'SELECT user.nickname,user.profile_picture,file.path,user.type FROM user INNER JOIN file ON user.profile_picture=file.id WHERE user.id = ? ';
  $req= $bdd->prepare($q);
  $req->execute([$id]);
  $resultsHeader= $req->fetchAll(PDO::FETCH_ASSOC);

  $path=$resultsHeader[0]["path"];

  $q='SELECT content FROM notif WHERE id_user=?';
  $req= $bdd->prepare($q);
  $req->execute([$id]);
  $resultsNotif= $req->fetchAll(PDO::FETCH_ASSOC);
}
  ?>






  <?php  if (isset($_COOKIE['theme'])){
            if ($_COOKIE['theme']==0) {
    ?>
    <link rel="stylesheet" type="text/css" href="Style/Style_header.css" />
  <?php }else { ?>
    <link rel="stylesheet" type="text/css" href="Style/Style_header_black.css" />
  <?php  }
  }else{ ?>
    <link rel="stylesheet" type="text/css" href="Style/Style_header.css" />
  <?php  } ?>
<header>
  <div id='id_user' style="display: none;">
    <?php echo $id ?>
  </div>
  <div  class="header">


  <div class="logo">
    <a href="index.php">
      <img src="Images/new_logo_1.png" width="100px"/>

    </a>
  </div>

  <div class="search">
    <div id=type style="display:none;">post</div>




    <input type="text" class="inputBar" name="search" oninput="search()" id="searchbar" placeholder="Recherche de poste" autocomplete="off">
    <ul id="list_result">

    </ul>
  </div>
  <div class="personnal">
    <?php if (isset($_SESSION['id'])) { ?>
      <div id="message" ><a href="message.php"><img src="Images/icons8-message-64.png " width="20px" height="20px"/></a></div>
      <div id="notif" >
        <img src="Images/icons8-cloche-100.png" width="30px" height="30px"/>
        <div id='all_notif'>
          <p>Vos notification :</p>
          <ul id='ul_notif'>
            <?php if (count($resultsNotif)>0){
              foreach ($resultsNotif as $key => $value){ ?>
                <li><?php echo $value['content']; ?>  </li>
              <?php }?>
                <button class="button_notif" onclick="delete_notif()">Suprimer les notification</button>
              <?php }else{ ?>
                <li>Vous n'avez aucune notification</li>
                <?php }?>
              </ul>
          </div>

      </div>





      <div id="account_nav">
        <img id="user_img" src="<?php echo $path ?>" alt='Image profile' height="30" />


    <ul>
      <li><a href="profil.php?user=<?php echo $resultsHeader[0]['nickname'];  ?>">Profil</a>
      </li>
      <li>
        <?php if($resultsHeader[0]["type"] === "admin"){?>
        <a href="Backoffice.php">Backoffice</a>
      </li>
  <?php  }?>
      <li>
        <a href='deco.php'>Déconnexion</a>
      </li>
    </ul>
    </div>
    <script src="js/notif_message.js"></script>
  <?php } else{ ?>
    <a href="signin.php" class="btn_co">Je me connecte</a>
    <a href="signup.php" class="btn_co">Je m'inscris</a>

  <?php } ?>
  </div>
  </div>
  <hr/>
</header>

<script src="js/searchbar_post.js"></script>
