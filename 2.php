<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php
		if(isset($_GET['Erreur'])){
			echo '<p>'.$_GET['Erreur'].'</p>';
		}
	?>
				<form action="signup_process.php" method="post" autocomplete="on">
						

					
					
					
						<div class="form-group">
						<label>Prénom</label><input type="name" class="form-control" name="name" placeholder="Entrez votre prénom"/>
						<label>Nom</label><input type="secondName" class="form-control" name="secondName" placeholder="Entrez votre nom"/>
						<label>Adresse e-mail</label><input type="email" class="form-control" name="mail" placeholder="Entrez votre Email">
						<label>Mot De Passe</label><input type="password" class="form-control" name="password"placeholder="Entrez votre Mot de Passe"/>
						<label>Confirmation Mot De Passe</label><input type="password"class="form-control" name="passwordConfirmation" placeholder="Vérification du mot de passe"/>
						<label>Date de Naissance</label><input type="date" name="birth" placeholder="Entrez votre Date de Naissance">
						<label>votre Pays</label><input type="location" name="location" placeholder="Entrez votre Pays d'origine">
						<label>Accepter les conditions générales</label><input type="checkbox" name="CGU">
						<input type="submit" value="Valider"/>
						</div>

					
					
				</form>



</body>
</html>