<?php
require('config.php');
include('Include/maintain_session.php');

$content = $_GET['title'];



//
$q = 'SELECT post.id,post.content,post.user_id,post.view,user.nickname,post.description FROM post INNER JOIN user ON post.user_id=user.id   WHERE title = ? and post.type="poste" ';

$req= $bdd->prepare($q);
$req->execute([$content]);
$results= $req->fetchAll(PDO::FETCH_ASSOC);


//ON AUGMENTE LE NOMBRE DE VUES DU POST
$query = 'UPDATE post SET view = ? WHERE title=?';
$req= $bdd->prepare($query);
$req->execute([$results[0]['view']+1,$content]);



$q = 'SELECT path,order_img FROM file WHERE post_id = ?';
$req= $bdd->prepare($q);
$req->execute([$results[0]['id']]);
$results2= $req->fetchAll(PDO::FETCH_ASSOC);

$q = 'SELECT count(user_id) AS result FROM like_assos WHERE post_id = ?';
$req= $bdd->prepare($q);
$req->execute([$results[0]['id']]);
$resultsLike= $req->fetch(PDO::FETCH_ASSOC);


//ON RECUPERE LES COMMENTAIRES
$q = 'SELECT content,date_of_comment,user.nickname FROM comment INNER JOIN user ON comment.user_id=user.id WHERE post_id = ?';
$req= $bdd->prepare($q);
$req->execute([$results[0]['id']]);
$resultComment= $req->fetchAll(PDO::FETCH_ASSOC);

$text = $results[0]['content'];
$text=str_replace('[OPENDIV]','<p>',$text);
$text=str_replace('[CLOSEDIV]','</p>',$text);
foreach ($results2 as $key => $value) {

	$text=str_replace('[IMAGE num='.$value['order_img'].']',"<img class='image_page' name=".$value['order_img']." src=".$value['path']." />",$text);
}




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

		<title><?php echo $content; ?></title>
	</head>
  <body onload="verif_subscribe();verif_like()">
    <?php include('Include/header.php');?>


<main class="main_page">
<div class="page_container">
	<div class="title_btn"><h1 class=title_page><?php echo $content; ?></h1><img src="Images/back.png" width="50" onclick="window.history.back()"></div>
	<p class="description_page"><?php echo $results[0]['description']; ?></p>
			<hr class="full_width" />

		<div class='text_page'>


			<?php echo nl2br($text);?>
		</div>
		<div class='end'>
				<?php
				echo '<div class="infos">';
				echo '<h4 >Likes : <span id="like_nbr">'.$resultsLike['result'].'</span></h4><br/>';
				echo '<h5>Nombre de Vues : '.$results[0]['view'].'</h5>';
				echo '</div>';
				?>

				<div class="autor">Auteur : <span class="creator"> <a href="profil.php?user=<?php echo $results[0]['nickname']; ?>"><?php echo $results[0]['nickname'] ?></a></span><div id='subscribe'><button id='subscribe_button' onclick="subscribe()">S'abonner</button></div></div>


				<div class="action_post">



				<div id="like_btn_div">
					<?php
				echo '<button id="like_btn" onclick="like()">Liker</button>';
				?>
				</div>
				<?php
				if ($_SESSION['id'] === $results[0]['user_id']){
					echo "<button id='modif' onclick='patch()'>Modifier</button>";
					?> <form  action="delete_post_user.php" method="post">
							<input type="hidden" name="post_id" value=<?php echo $results[0]['id']; ?>>
							<input type="submit" name="submit" value="Suprimer le post">
					</form>
					<?php
				}
				else {
				?>
				<button id="signal"  class="signal_btn" onclick="signal_btn()">Signaler</button>
			<?php } ?>
				</div>



				<div id="signal_cont">

				</div>

		</div>

	</div>
	<div class="page_container">
		<div class="add_comment">
				<button onclick="comment()">Ajouter un commentaire</button>
		</div>


		<div id="comment">

			<?php
			foreach($resultComment as $key => $value) {
				echo '<div class="comment_page">';
			 echo '<h5>'.$value['nickname'].'</h5>';
			 echo '<p>'.$value['content'].'</p>';
			 echo '<small>'.$value['date_of_comment'].'</small>';
			 echo '</div>';
		}
		?>

		</div>
	</div>
</main>




				<div style="display: none;"><div id='subscribed_id'><?php echo $results[0]['user_id'] ?></div>
					<div id='user_id'><?php echo $_SESSION['id'] ?></div></div>

			<div id="id_title" style="display:none;"><?php echo $results[0]['id']; ?></div>
			<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
				<script src="js/tracking.js"></script>
		  	<script src="js/page.js" charset="utf-8"></script>
  </body>
</html>
