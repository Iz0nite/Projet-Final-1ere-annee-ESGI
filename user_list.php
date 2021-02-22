<?php

require('config.php');
include('Include/maintain_session.php');



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


			if ($_SESSION['user'] === 'admin'){

				?>
				<div class='InputBar' >

					<div id=researchDiv>
						<div id=type style="display:none;">user</div>
            <?php if (!isset($_GET['user'])){ ?>
              <input type="text" name="search" oninput="search()" id="searchbar" placeholder="Recherche d'utilisateur" autocomplete="off">
            <?php }
            else { ?>
              <input type="text" name="search" oninput="search()" id="searchbar" placeholder="Recherche d'utilisateur" autocomplete="off" value="<?php echo $_GET['user'];  ?>">
            <?php } ?>

						<ul id="list_result">

				</ul>
				</div>

				<p><a href="index.php">Site</a></p>
				</div>
				<div id="division">

				</div>




			<?php
				}
				else {
          header('Location: index.php?msg=Vous n avez pas les autorisations');
			}
    }
    else{
      header('Location: index.php?msg=Connectez-vous');
    }

			?>
			</main>
      <script src="js/avert.js" charset="utf-8"></script>
      <script src="js/searchbar_post.js" charset="utf-8"></script>
		</body>
</html>
