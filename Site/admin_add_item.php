<?php
if(isset($_POST['nom_produit']) && isset($_POST['code_EAN13']) && isset($_POST['image']) && isset($_POST['qte_ajout'])) {
	$error = 0;
	try {
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=uphf_astre_tracabilite', 'root', '');
	}
	catch (Exception $error) {
		die('Erreur de la base SQL : ' . $error->getMessage());
	}
	if($error == 0){
		try {
			$requete = $bdd->query("SELECT * FROM stock WHERE code_EAN13='".$_POST['code_EAN13']."'");
		}
		catch (Exception $error) {
			die('Erreur de la base SQL : ' . $error->getMessage());
		}
		if($requete->rowCount() > 0) {
			$data = $requete->fetch();
		    try {
		    	$requete = $bdd->query("UPDATE `stock` SET `qte_stock`='".$data['qte_stock']+$_POST['qte_ajout']."' WHERE code_EAN13='".$_POST['code_EAN13']."'");
	    	}
            catch (Exception $error) {
    			die('Erreur de la base SQL : ' . $error->getMessage());
    		}
			if($error == 0) {
			    header('Location:admin.php?obj_exists_but_update');
            }
		}
		else {
		    try {
		    	$requete = $bdd->query("INSERT INTO `stock` (`nom_produit`, `code_EAN13`, `image`, `qte_stock`) VALUES ('".$_POST['nom_produit']."', '".$_POST['code_EAN13']."', '".$_POST['image']."', '".$_POST['qte_ajout']."')");
	    	}
            catch (Exception $error) {
    			die('Erreur de la base SQL : ' . $error->getMessage());
    		}
			if($error == 0) {
			    header('Location:admin.php?record_done');
            }
		}
	}
}
else {
	header('Location:admin.php?empty_field');
}
?>

<!DOCTYPE HTML>
<head>
	<title>TP Identification</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>