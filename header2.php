<header>
  <div class='img'>
    <img src="Images/Logo.png" width="80px">
  </div>
  <div class ='nav'>
    <a href="index.php" class="select"><div>
      Accueil

    </div>
    </a>
    <a href="#"><div>
      Abonnements
    </div>
    </a>
    <a href="#"><div>
      Tendances
    </div>
    </a>
    <a href="#"><div>
      Div 4
    </div>
    </a>
  </div>
  <div class='account'>

    <?php
		 if (isset($_SESSION['id'])) {
       $id=$_SESSION['id'];
       $q = 'SELECT pseudo FROM user WHERE ID = ?';
       $req= $bdd->prepare($q);
       $req->execute([$id]);
       $results= $req->fetchAll();

			 echo "<p>Bienvenue ".$results[0][0]."</p>";
			 echo " <a href='profil.php'><div>Profil</div></a>";
			 echo "<a href='deco.php'><div>deconnexion</div></a>";
		 }else {
		 		echo ("	<a href=\"signin.php\"><div>page de connexion</div></a><a href=\"signup.php\"><div>page d'inscription</div></a>");
		 }
		 ?>
  </div>

</header>
