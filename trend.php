<?php
	require('config.php');
	include('Include/maintain_session.php');





// 'SELECT post.title,post.content,user.nickname FROM post INNER JOIN user ON post.user_id=user.id'
	$q = "SELECT post.id,post.title,post.view,post.content,post.description,user.nickname,
	file.path,category.name,post.difficulty FROM post INNER JOIN user ON post.user_id=user.id  LEFT JOIN category ON post.category_id=category.id LEFT JOIN file ON post.id=file.post_id WHERE post.type = 'poste' AND (file.order_img='image-0' OR file.order_img IS NULL) ORDER BY post.dateToday DESC LIMIT 5 ";
	$req = $bdd->query($q);
	$results_post = $req->fetchAll(PDO::FETCH_ASSOC);



	$q ="SELECT category.name,category.id,file.path FROM category INNER JOIN file ON category.img_id=file.id";
	$req = $bdd->query($q);
	$result_cat=$req->fetchAll(PDO::FETCH_ASSOC);

	$q = "SELECT * FROM post WHERE type = 'event' ";
	$response = $bdd->query($q);
	$result_event = $response->fetchAll(PDO::FETCH_ASSOC);




	?>




<!DOCTYPE html>
<html>
	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="Desciption" content="Page contenant toutes les nouveautés du forum !">
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

		<title>Tendances</title>
	</head>

	<body>
		<?php include('Include/header.php');
					include('Include/navbar.php'); ?>

		<main>

			<div class="left_div">
				<div class="title_page">
				<h1>Actualités</h1>
				<small>Ici sont affichés les derniers posts du forum !</small>

				</div>
				<div class="nav_page">
					<select id="category" onchange="category()">
						<option>Catégorie</option>
		        <?php foreach ($result_cat as $key => $value) {?>
		          <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
		      <?php  } ?>

		      </select>
				</div>

				<?php foreach ($results_post as $key => $value) {

					$q = 'SELECT count(user_id) AS result FROM like_assos WHERE post_id = ?';
					$req= $bdd->prepare($q);
					$req->execute([$results_post[$key]['id']]);
					$resultsLike= $req->fetch(PDO::FETCH_ASSOC);


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
							<p>Créé par : <strong><a href="profil.php?user=<?php echo  $results_post[$key]['nickname']; ?>"> <?php echo  $results_post[$key]['nickname']; ?></a></strong></p>
							<ul class="cat_list">
								<li><?php echo  $results_post[$key]['name']; ?></li>
							</ul>
						</div>
						<div>
							<p style="align-self:flex-end">Vue(s) : <?php echo  $results_post[$key]['view']; ?></p>
							<p style="align-self:flex-end">Like(s) : <?php echo  $resultsLike['result']; ?></p>
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
			<div class="event">
				<h2>Événements</h2>
				<?php
				foreach ($result_event as $key => $value) {
          echo '<div class="column_events">';
          echo '<h3>'.nl2br($result_event[$key]['title']).'</h3>';
            echo '<p>'.nl2br($result_event[$key]['content']).'</p>';
						echo '<a href="'. $result_event[$key]['description'] .'">Lien</a>';
            echo '</div>';
         }
				 ?>
			</div>
		</main>
		</div>
<script type="text/javascript">
	let htmll = document.getElementsByTagName('html')[0];

	function stop(){
		htmll.classList.add('scroll-stop');

	}
	function unstop(){
		htmll.classList.remove('scroll-stop');

	}
</script>
	<script src="js\category.js"></script>
  </body>
</html>
