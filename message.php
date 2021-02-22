<?php
	require('config.php');
	include('Include/maintain_session.php');

  // $q = "SELECT id_convo,user.nickname,file.path FROM convo_assoc INNER JOIN user ON user.id=convo_assoc.id_user  INNER JOIN file ON file.id=user.profile_picture
	// INNER JOIN convo ON convo.id = id_convo  WHERE
	// id_convo IN (SELECT id_convo FROM convo_assoc WHERE id_user = ?)
	// AND id_user <> ? ORDER BY convo.last_mess DESC" ;

	$q='SELECT id_convo,UNIX_TIMESTAMP(convo.last_mess) as last_mess,user.nickname,file.path,SUM(CASE WHEN receive_user = ? THEN readed ELSE 0 END) AS sum FROM convo_assoc INNER JOIN user ON user.id=convo_assoc.id_user INNER JOIN file ON file.id=user.profile_picture INNER JOIN convo ON convo.id = id_convo LEFT JOIN message ON message.convo = convo.id WHERE id_user <> ?
	 AND id_convo IN (SELECT id_convo FROM convo_assoc WHERE id_user = ?) GROUP BY id_convo ORDER BY convo.last_mess DESC';
  $req = $bdd->prepare($q);
  $req->execute([
		$_SESSION['id'],
		$_SESSION['id'],
		$_SESSION['id']
	]);
  $results_convo = $req->fetchAll(PDO::FETCH_ASSOC);

  // $q = "SELECT user.nickname,convo.id,file.path FROM convo INNER JOIN user ON user.id=convo.second_user INNER JOIN file ON file.id=user.profile_picture WHERE  first_user = ?";
  // $req = $bdd->prepare($q);
  // $req->execute([$_SESSION['id']]);
  // $results_convo2 = $req->fetchAll(PDO::FETCH_ASSOC);



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
		<title>Messagerie</title>
	</head>

	<body>
		<?php include('Include/header.php');
					include('Include/navbar.php'); ?>
    <div id='pseudo' style="display:none;"><?php echo $_SESSION['id']?></div>
		<main class="message">
      <div>

        <?php foreach ($results_convo as $key => $value): ?>

          <div onclick="message_prepare(this)" id="<?php echo $value['id_convo']?>"  >
            <img src="<?php echo $value['path']?>" width="75" height="75"/>
						<div>
							<h1 class="<?php echo ($value['sum']>0 ? 'unread' : 'read')  ?>"><?php echo $value['nickname']?></h1>
							<small><?php echo date('H:i',$value['last_mess'])?></small>
						</div>
          </div>

        <?php endforeach; ?>

      </div>
      <div >
          <div id="convo">

          </div>
          <div>
						<form class="message_send" onsubmit="return false;">
							<input class="input_mess" id="message_txt"></input><button onclick="send()">Envoyer</button>
							</form>
					</div>
      </div>
			<div id="get" style="display:none;"><?php echo $_GET['convo'] ?></div>
      <script src="js/message.js"></script>
		</main>
		</div>
