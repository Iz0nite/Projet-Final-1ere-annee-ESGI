
<header>

<nav class=navbar>
  <div  class="logo">
  <img src="Images/Logo.png" width="80px">
  </div>

<div class="research_ul">

  <div class="research">
  <input class="champ" type="text" value="Recherche"/>
  </div>

  <ul>
    <a href="index.php"><li>Accueil</li></a>
    <a><li>Forum</li></a>
    <a><li>Abonnements</li></a>

  </ul>

	</div>

	<div class="profil">
		<div>


		<?php
		 if (isset($_SESSION['id'])) {
       $id=$_SESSION['id'];
       $q = 'SELECT pseudo FROM user WHERE ID = ?';
       $req= $bdd->prepare($q);
       $req->execute([$id]);
       $results= $req->fetchAll();
			 echo "<p>Bienvenue ".$results[0][0]."</p>";
			 echo "<a href='deco.php'><h4>deconnexion</h4></a>";
			 echo "<a href='profil.php'><h4>Profil</h4></a>";
		 }else {
		 		echo ("	<a href=\"signin.php\"><h4>page de connexion</h4></a><a href=\"signup.php\"><h4>page d'inscription</h4></a>");
		 }
		 ?>
		 </div>
	</div>

  </nav>





</header>
