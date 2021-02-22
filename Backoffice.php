<?php
	require('config.php');
	include('Include/maintain_session.php');





	$q = 'SELECT id FROM user ';
	$response = $bdd->query($q);
	$result = $response->fetchAll(PDO::FETCH_ASSOC);



	$q = "SELECT id, title FROM post WHERE type = 'Poste' ";
	$req = $bdd->query($q);
	$results = $req->fetchAll(PDO::FETCH_ASSOC);

	$q='SELECT country, count(*) FROM user GROUP BY country order by count(*) DESC limit 10 ';
  $req = $bdd->query($q);
  $results3 = $req->fetchAll(PDO::FETCH_ASSOC);

  $q='SELECT birth, year(birth) FROM user';
  $req = $bdd->query($q);
  $results4 = $req->fetchAll(PDO::FETCH_ASSOC);


$time = (time()-(60*5));

	$q='SELECT count(*)  FROM user WHERE UNIX_TIMESTAMP(last_pass)> ?';
	$req = $bdd->prepare($q);
	$req->execute([$time]);
	$results5 = $req->fetch(PDO::FETCH_ASSOC);



	?>


<!DOCTYPE html>
<html>
<head>
	<title>Back Office</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Style/Style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body >

	<main>
		<div class="hidden">

		<div id="country_count">
		  <?php
		  foreach ($results3 as $key => $value){
		    echo $value['count(*)'].",";

		  }

		   ?>

		 </div>

		  <div id="country_name" >
		     <?php
		     foreach ($results3 as $key => $value){
		       echo $value['country'].",";

		     }

		      ?>
		</div>

		<div id="birth_user" >
		        <?php
		        foreach ($results4 as $key => $value){
		          echo $value['year(birth)'].",";

		        }

		         ?>

		  </div>

		</div>



		<?php
		include('Include/BackOffice_Nav.php');
		if (isset($_SESSION['id'])){
			$q = 'SELECT type FROM user WHERE id = ? ';
			$req = $bdd->prepare($q);
			$req->execute([$_SESSION['id']]);
			$result_admin = $req->fetch(PDO::FETCH_ASSOC);

			if ($result_admin['type'] === 'admin'){



			?>

			<div class='InputBar' >
				<div id=researchDiv>
					<div id=type style="display:none;">post</div>

			<input type="text" name="search" oninput="search()" id="searchbar" placeholder="Recherche de poste" autocomplete="off">
			<ul id="list_result">

			</ul>
			</div>


			<p><a href="index.php">Site</a></p>
			</div>

			<div class="row">
				<div class="column">
					<div class="first-row">
						<div><img src="svg/cloud.svg" width="50px"><div><h1>Connectés</h1><p class='strong'><?php echo $results5['count(*)'] ?></p></div></div>

						<div><img src="svg/cloud.svg" width="50px"><div><h1>Inscrits</h1><p class='strong'><?php echo count($result) ?></p></div></div>

						<div class="BackYellow"><img src="svg/cloud.svg" width="50px"><div><h1>Articles</h1><p class='strong'><?php echo count(	$results) ?></p></div></div>
					</div>
					<div id="bigGraph" class="bigGraph">
						<canvas id="canvas_country" class="test" ></canvas>
						<canvas id="canvas_birth" class="test" ></canvas>

					</div>
					<div class="Second-row">
						<div flex="row row-category">
							<form enctype="multipart/form-data" action="new_category_process.php" method="post">
								<div class="category">


								<h3>Création de Catégorie</h3>
								<label for=title"">Titre de catégorie:</label>
								<input type="text" name="title" placeholder="Nom">
								<label for=title"">Description catégorie:</label>
								<textarea name="description"  oninput="auto_grow(this)" placeholder="Desciption"></textarea>
								<!-- <input type="text" name="description" placeholder="Desciption"> -->
								<input type="file" name="img" class="file" />
								<input type="submit" name="submit" value="valider">
								</div>
								</form>
						</div>
						<div>
							<h3>Export XML</h3>
							<input type="email" id="mail_xml"/>
							<button onclick="XML_SEND()">Envoyer</button>
						</div>

					</div>
				</div>

				<div class="SecondSection">

			<div>
				<h1>Liste de Post</h1>
				<table>
					<tr>
						<th>id</th>
						<th>Titre</th>
					</tr>
					<?php foreach ($results as $key => $value) { ?>
						<tr>
						 <td><?php echo $value['id']; ?></td>
						 <td><?php echo $value['title'];?></td>
						 <td class="formclick">
							 <form action="page.php" method="get" >
								 <input type="submit" name="title" value="<?php echo $value['title'];?>">
							 </form>
						 </td>
		</td>
					</tr>
					<?php } ?>


				</table>
			</div>


				</div>
			</div>
			<div id="demo">

			</div>
		<script src="js/send_xml.js" charset="utf-8"></script>
		<script src="js/canvas.js" charset="utf-8"></script>
		<script src="js/searchbar_post.js" charset="utf-8"></script>
		<script>
		function auto_grow(element) {
			element.style.height = "5px";
			element.style.height = (element.scrollHeight)+"px";
			}</script>

		<?php
			}
			else  {
				header('Location: index.php?msg=Vous n avez pas les autorisations');
		}
		}

		else { ?>
			<h1>
				Il faut se connecter
			</h1>
		<?php }?>



		</main>
</body>
</html>
