<?php
	require('config.php');
	include('Include/maintain_session.php');

  //Affichage de toutes les pages ou nous sommes abonnées.      WHERE post.user_id = subscribe.subscribed
  $q="SELECT post.title,post.view,post.content,post.description,user.nickname,
	file.path,category.name,post.difficulty FROM post LEFT JOIN category ON post.category_id=category.id LEFT JOIN file ON post.id=file.post_id INNER JOIN user ON post.user_id=user.id INNER JOIN subscribe ON post.user_id=subscribe.subscribed WHERE subscribe.subscriber = ? ORDER BY post.dateToday DESC  LIMIT 5";

  $req= $bdd->prepare($q);
  $req->execute([$_SESSION['id']]);
  $results_post= $req->fetchAll(PDO::FETCH_ASSOC);

	$q='SELECT user.nickname,file.path FROM subscribe INNER JOIN user ON subscribe.subscribed=user.id INNER JOIN file ON user.profile_picture=file.id WHERE subscribe.subscriber= ?';
	$req= $bdd->prepare($q);
	$req->execute([$_SESSION['id']]);
	$results= $req->fetchAll(PDO::FETCH_ASSOC);

	$q ="SELECT category.name,category.id,file.path FROM category INNER JOIN file ON category.img_id=file.id";
	$req = $bdd->query($q);
	$result_cat=$req->fetchAll(PDO::FETCH_ASSOC);

	?>

<!DOCTYPE html>
<html>
	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="Desciption" content="Ceci est la page d'accueil">
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
		<title>Abonnement</title>
	</head>

	<body>
		<?php include('Include/header.php');
					include('Include/navbar.php'); ?>

    <?php if (!(isset($_SESSION['id']))){
  		echo ("	<p>Connectez vous pour avoir accès à vos abonnement</p>");

  	}
      ?>




			<main>

				<div class="left_div">
					<div class="title_page">
					<h1>Abonnement(s)</h1>
					<small>Ici sont affichés les posts de vos utilisateurs et ulisatrices préférés !</small>

					</div>
					<?php foreach ($results_post as $key => $value) {




						$content = substr($results_post[$key]['content'],0,30);
						?>
						<div name="post">
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
								<p>Créer par : <strong><a href="profil.php?user=<?php echo  $results_post[$key]['nickname']; ?>"> <?php echo  $results_post[$key]['nickname']; ?></a></strong></p>
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
				<div class="right_div">
						<div class="suscribed">
								<ul class="user_sub">
									<?php foreach ($results as $key => $value) { ?>
										<li><div><img class="user_img" src="<?php echo  $value['path']; ?>" alt="" height="35px"></div> <a href="profil.php?user=<?php  echo  $value['nickname'];  ?>"><?php echo  $value['nickname']; ?></a> </li>
										<?php }  ?>
								</ul>
						</div>


				</div>
			</main>
			</div>

		</div>
  </body>

</html>
<div class="all_element_subscribe">
<!-- <div class="suscribed">
	<nav>
		<ul>
			<?php foreach ($results as $key => $value) { ?>
				<li><img src="<?php echo  $value['path']; ?>" alt="" height="35px"><?php echo  $value['nickname']; ?> </li>

				<?php }  ?>
		</ul>
	</nav>

</div> -->
