<?php
//session_start();
require('config.php');


$q = 'SELECT id, title FROM post';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

$q = 'SELECT name FROM category';
$req = $bdd->query($q);
$results2 = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des utilisateurs</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->

		<link rel="stylesheet" type="text/css" href="Style/Style_header.css" />
	</head>
	<body>
		<?php include('Include/header.php'); ?>
		<h1>Catégorie</h1>


			<?php foreach ($results2 as $key => $value){ ?>

				<button onclick="category(this)"><?php echo $value['name']; ?></button>
				<?php } ?>
		<h1>Liste des utilisateurs</h1>
		<div class="conteineur">


		<table id='table'>
		  <tr>
		    <th>id</th>
		    <th>Titre</th>
		  </tr>
		  <?php foreach ($results as $key => $value) { ?>
		  	<tr>
			   <td><?php echo $value['id']; ?></td>
			   <td><?php echo $value['title'];?></td>
				 <td>
					 <form action="page.php" method="get">
			       <input type="submit" name="title" value="<?php echo $value['title'];?>">
			     </form>
				 </td>
			</tr>
		  <?php } ?>


		</table>
			</div>
		<script src="js/category.js" charset="utf-8"></script>
	</body>
</html>
