<?php
	 require('config.php');
	 include('Include/maintain_session.php');

	 $q = "SELECT * FROM post WHERE type = 'event' ";
	 $response = $bdd->query($q);
	 $result = $response->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Back Office</title>

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
  <div class="column">
      <div class='InputBar'>
				<form action="event_process.php" method="POST">

        <input type="text" name="title" placeholder="Titre">
				<input type="text" name="content" placeholder="Contenu">
				<input type="text" name="link" placeholder="Lien">

        <input type="submit" value="Créer un nouvel événement"/>
			</form>
      </div>
      <div class="event">
        <h1>Liste des événements existants</h1>

        <?php

        foreach ($result as $key => $value) {
          echo '<div class="column_events">';
          echo '<h2>'.nl2br($result[$key]['title']).'</h2>';
            echo '<p>'.nl2br($result[$key]['content']).'</p>';
						echo "<a href='".$result[$key]['description']."'>".'Lien'.'</a>';
						echo '<button name="'.$result[$key]['id'].'" class="supp_btn" onclick="supp_event(this)">Supprimer</button>';

            echo '</div>';
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
			 	<script src="js/backoffice_events.js" charset="utf-8"></script>
      </div>
  </div>
