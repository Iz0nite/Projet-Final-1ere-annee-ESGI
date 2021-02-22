<?php
require('config.php');
session_start();
include('Include/maintain_session.php');

$request = 'SELECT signals.id,reason,reason_dev,user.nickname,post.title,user.id AS userid FROM signals INNER JOIN user ON signals.user_id = user.id INNER JOIN post ON signals.post_id = post.id';
$response = $bdd->query($request);
$resultat = $response->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Back Office</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Style/Style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>

	<main>
		<?php
		include('Include/BackOffice_Nav.php');
		if (isset($_SESSION['user'])){


		 if ($_SESSION['user'] === 'admin'){ ?>

		<div>
			<h1>Signalements</h1>
		</div>
		<div class="row2">

			<?php
			if(count($resultat)>0){

			foreach ($resultat as $key => $value){

				?>

				<div>
					<h2><?php echo $value['reason']; ?></h2>
					<p>
					<?php echo $value['reason_dev']; ?>
					</p>
					<p>
						Utilisateur concerné : <a href="user_list.php?user=<?php echo $value['nickname']; ?>">#<?php echo $value['nickname']; ?></a>
					</p>
					<p>
						post concerné : <a href="page.php?title=<?php echo $value['title']; ?>">#<?php echo $value['title']; ?></a>
					</p>
					<div class="imgSignals">
						<div class='location'>
								<a onclick="avert('<?php echo $value['id']; ?>')"><img src="svg/location.svg" height="20px"alt="d"/></a>
						</div>
						<div class='bulb'>
								<a href="signals_process.php?action=delete-post&id=<?php echo $value['id']; ?>"><img src="svg/lightbulb.svg" height="20px"alt="d"/></a>
						</div>
						<div class='delete'>
								<a id="delete" href="signals_process.php?action=delete-signals&id=<?php echo $value['id']; ?>"><img src="svg/delete.svg" height="20px" alt="delete" /></a>
						</div>
					</div>
				</div>
			<?php }
			}
			else{

				echo '<h1>
				Pas De Signalements
				</h1>';

			}
		}
		else {
			header('Location: index.php?msg=Vous n avez pas les autorisations');
		}
		}
		else{
				header('Location: index.php?msg=Connectez-vous');
			}


				?>
				<div style="display:none;" id="info"><?php echo $value['userid'];?>
				</div>

				<script src="js/avert.js" charset="utf-8"></script>
		</div>
	</main>
</body>
</html>
