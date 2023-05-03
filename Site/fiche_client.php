<?php
if (isset ($_POST['nom_client'])){
	$error = 0;
	try{$bdd = new PDO('mysql:host=127.0.0.1;dbname=uphf_astre_tracabilite', 'root', '');}
	catch (Exception $error){die('Erreur de la bse SQL : ' . $error->getMessage());}
	
	try {$requete = $bdd->query("SELECT * FROM ticket_client WHERE nom_client='".$_POST['nom_client']."'");}
	catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}

	if($requete->rowCount() < 0) {header('Location:index.php?user_dont_exists');}
}
else {header('Location:index.php?no_user_set');}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>TP Identification</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<form action="index.php"><input type="submit" value="Retour à l'acceuil" /></form><br/>
<table>
	<center><h1>Liste des passages du client</h1>
	<thead>
		<tr>
			<td>Identifiant interne</td>
			<td>Date de passage</td>
			<td>Lien du ticket</td>
			<td>Lien du QR Code</td>
		</tr>
	</thead>
	<tbody>
<?php
while ($data = $requete->fetch())
{echo "<tr><td>".$data['id']."</td><td>".$data['date']."</td><td><a href='tickets/".$data['id'].".txt'>Format texte</a></td><td><a href='tickets/".$data['id'].".png'>QR Code</a></td></tr>";}
echo "</tbody></table>";
$requete->closeCursor();
?>
</body>
</html>