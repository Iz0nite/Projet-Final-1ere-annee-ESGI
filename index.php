<?php
	require('config.php');
	include('Include/maintain_session.php');








	$q = 'SELECT category.name,category.description,file.path FROM category INNER JOIN file ON category.img_id=file.id';
	$req = $bdd->query($q);
	$results_category = $req->fetchAll(PDO::FETCH_ASSOC);

//MELANGE DES CATEGORIES POUR UN AFFICHAGE VARIER
shuffle($results_category);
	?>

<!DOCTYPE html>
<html>
	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="Desciption" content="Forum de la fabrique ! Ici retrouvez des tutoriels DIY pour tout les ages.">
		<meta name="description" content="DIY, petit, grand, informatique,tutoriel, la fabrique">
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="robots" content="index,follow">
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


		<title>Accueil</title>
	</head>

	<body class="body-back">

		<?php include('Include/header.php'); ?>
		<?php if(isset($_GET['Err'])){
			if($_GET['Err'] === "1"){
				echo '<h1 class="error_msg">Page introuvable</h1>';
			}
			else if ($_GET['Err'] === "2"){
				echo '<h1 class="error_msg">Erreur Serveur</h1>';
			}

		} ?>
		<main class="main">
			<div class="break">
				<div>


				<h1>Bienvenue sur le site de la Fabrique</h1><p>Ce Forum à pour but de rassembler une communauté de créateurs ainsi que de makers prêts à créer des tutos, à apporter des améliorations et à partager leurs créations</p>
				<p>Ce site est ouvert à tous et à toutes, les personnes souhaitant partager leurs expériences comme ceux souhaitant découvrir l'univers du DIY. Si vous êtes jeune, veuillez demander de l'aide à vos parents pour ne pas vous blesser!</p>
				<a href="trend.php">Voir le Forum !</a>
				</div>
			</div>
			<div class="creation">
					<div class="img-creation"><img src="Images_user/ines-alvarez-fdez-L_N7BaNLC5Y-unsplash.jpg" /></div>
					<div style='flex-direction:column;'>
						<span>Le site possède de nombreuses catégories<br />
									De la couture à l'éléctronique en passant par le dessin<br /></span>


									<a href="trend.php">Accès à la liste des catégories</a>


					</div>
			</div>
			<div class="demo">
				<div>


				<p>Voici un exemple d'utilisation du forum. Vous pouvez commenter, juger, ainsi que créer vos propres DIY et les partager avec la communauté.</p>
					<div>

					<img src="Images_user/220px-Closeup_of_pixels.jpg" /></div>
					</div>
			</div>
			<div class="log">
				<div >
					<span>Déjà inscrit?<br />
								Pour se connecter ça se passe ici!<br /></span>


								<a href="signin.php">Je me connecte !</a>


				</div>
				<div class="line"></div>
					<div >
						<span>Pas encore de compte?<br />
									Démarrez votre expèrience ici!<br /></span>


									<a href="signup.php">Je m'inscris !</a>


					</div>


						</div>
						<small class="secret"><a href="secret.php">viens la si tu veux connaître la vériter</a></small>
		</main>



	</body>
</html>

<!-- <div class="conteineur">



	<div class="lala">






		<div class="site_category">
			<h1>Un exemple de catégorie</h1>
			<div class="site_category_content">
					<?php
					for ($i=0; $i < 3 ; $i++) {
?>

						<div class="card" style="width: 18rem;">
							<img src="<?php echo $results_category[$i]["path"];?>" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title"><?php echo $results_category[$i]["name"];?></h5>
								<p class="card-text"><?php echo $results_category[$i]["description"];?></p>
								<a href="#" class="btn btn-primary">S'y rendre !</a>
							</div>
						</div>
					<?php } ?>



			</div>
		</div>

	</div>



	</div> -->
