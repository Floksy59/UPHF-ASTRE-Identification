<!DOCTYPE HTML>
<html>
<head>
	<title>TP Identification</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<form action="index.php"><input type="submit" value="Retour à l'acceuil" /></form><br/>
<?php if(isset ($_GET['empty_field'])){echo "Un champ est vide.<br/>";}
elseif(isset ($_GET['obj_exists_but_update'])){echo "L'objet existait déjà, la quantitée indiquée additionnée à celle stockée.<br/>";}
elseif(isset ($_GET['record_done'])){echo "L'objet a bien été ajouté.<br/>";}
else{echo "Ajoutez un objet :<br/>";}
?>
<form method="post" action="admin_add_item.php">
	<p>Nom du produit : <input type="text" name="nom_produit" /></p>
	<p>Code EAN-13 : <input type="text" name="code_EAN13" /></p>
	<p>Image : <input type="text" name="image" /></p>
	<p>Quantité : <input type="text" name="qte_ajout" /></p>
	<p><input type="submit" value="Ajouter" /></p>
</form>
<table>
	<center><h1>Objets actuellement en stock</h1>
	<thead>
		<tr>
			<td>Produit</td>
			<td>Code EAN13</td>
			<td>Image</td>
			<td>Quantité</td>
		</tr>
	</thead>
	<tbody>
<?php
$error = 0;
try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=uphf_astre_tracabilite', 'root', '');
}
catch (Exception $error)
{
	die('Erreur de la bse SQL : ' . $error->getMessage());
}

if ($error == 0){
	$requete = $bdd->query("SELECT * FROM stock");
	while ($data = $requete->fetch())
	{
	echo "<tr><td>".$data['nom_produit']."</td><td>".$data['code_EAN13']."</td><td><image src='".$data['image']."' height=100px width=100px /></td><td>".$data['qte_stock']."</td></tr>";
	}
	echo "</tbody></table>";
	$requete->closeCursor();
}
?>
</body>
</html>