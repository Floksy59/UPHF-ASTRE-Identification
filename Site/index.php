<!DOCTYPE HTML>
<html>
<head>
	<title>TP Identification</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <form method="post" action="admin.php"><input type="submit" value="Administration des stocks" /></form><br/>
    <?php if(isset ($_GET['no_items'])){echo "Aucun produit n'a été saisi.<br/>";}
    elseif(isset ($_GET['done'])){
        if (isset ($_GET['ticket'])) {
            echo "Mise à jour des stocks effectuée. <a href='tickets/".$_GET['ticket'].".txt'>Ticket sous format texte</a> - <a href='tickets/".$_GET['ticket'].".png'>Ticket sous format QR Code</a><br/>";
        }
        else {
            echo "Mise à jour des stocks effectuée. Ticket client indisponible.";
        }
    }
    else{echo "<br/><br/>";}
    ?>
	<form method="post" action="client_ticket.php">
		<p>Nom du client : <input type="text" name="nom_client" /></p>
		<p>Mail du client : <input type="mail" name="mail_client" /></p>
		<p>Produits achetés : <input type="text" name="client_buyed" /></p>
		<p><input type="submit" value="Panier complètement scanné" /></p>
	</form>
	<br/><br/>
	<form method="post" action="fiche_client.php"><p>Nom du client : <input type="text" name="nom_client" />  <input type="submit" value="Consulter" /></p></form>
	<?php if (isset($_GET['user_dont_exists'])){echo "Ce client n'exsite pas !";}
	elseif (isset($_GET['no_user_set'])){echo "Aucun nom de client entré.";}
	?>
</body>
</html>