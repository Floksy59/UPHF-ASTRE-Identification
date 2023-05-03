<?php
require_once('phpqrcode/qrlib.php');

if(isset($_POST['client_buyed'])) {
	$error = 0;
	$handle = null;

	try {$bdd = new PDO('mysql:host=127.0.0.1;dbname=uphf_astre_tracabilite', 'root', '');}
	catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}

	if (isset($_POST['nom_client']) == true && isset ($_POST['mail_client']) == true){
		try {$requete = $bdd->query("INSERT INTO `ticket_client` (`id`, `nom_client`, `mail_client`, `date`,`produits`) VALUES (NULL,'".$_POST['nom_client']."', '".$_POST['mail_client']."', '".date("Y-m-d H:i:s")."', '".$_POST['client_buyed']."')");}
		catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
	}
	if (isset($_POST['nom_client']) == true && isset ($_POST['mail_client']) == false){
		try {$requete = $bdd->query("INSERT INTO `ticket_client` (`id`, `nom_client`, `mail_client`, `date`,`produits`) VALUES (NULL,'".$_POST['nom_client']."', '".null."', '".date("Y-m-d H:i:s")."', '".$_POST['client_buyed']."')");}
		catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
	}
	if (isset($_POST['nom_client']) == false && isset ($_POST['mail_client']) == true){
		try {$requete = $bdd->query("INSERT INTO `ticket_client` (`id`, `nom_client`, `mail_client`, `date`,`produits`) VALUES (NULL,'".null."', '".$_POST['mail_client']."', '".date("Y-m-d H:i:s")."', '".$_POST['client_buyed']."')");}
		catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
	}
	if (isset($_POST['nom_client']) == false && isset ($_POST['mail_client']) == false){
		try {$requete = $bdd->query("INSERT INTO `ticket_client` (`id`, `nom_client`, `mail_client`, `date`,`produits`) VALUES (NULL,'".null."', '".null."', '".date("Y-m-d H:i:s")."', '".$_POST['client_buyed']."')");}
		catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
	}
	
	try {$requete = $bdd->query("SELECT * FROM ticket_client WHERE date='".date('Y-m-d H:i:s')."'");}
	catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}

	if($requete->rowCount() > 0) {
		$data = $requete->fetch();
		$id_actuel = $data['id'];
		$handle = fopen('tickets/'.$id_actuel.'.txt', "w");
		if (isset($_POST['nom_client']) == true && isset ($_POST['mail_client']) == true){
			fwrite($handle, $data['date']."\n".$data['nom_client']."\n".$data['mail_client']."\n\n");
		}
		if (isset($_POST['nom_client']) == true && isset ($_POST['mail_client']) == false){
			fwrite($handle, $data['date']."\n".$data['nom_client']."\n\n");
		}
		if (isset($_POST['nom_client']) == false && isset ($_POST['mail_client']) == true){
			fwrite($handle, $data['date']."\n".$data['mail_client']."\n\n");
		}
		if (isset($_POST['nom_client']) == false && isset ($_POST['mail_client']) == false){
			fwrite($handle, $data['date']."\n\n");
		}
		$requete->closeCursor();
	}
	
	$client_buyed_final_char = substr($_POST['client_buyed'], -1, 1);
	if($client_buyed_final_char == ";"){$client_buyed = substr($_POST['client_buyed'], 0, -1);}
	else{$client_buyed = $_POST['client_buyed'];}
	
    // Utilisation de la fonction explode() pour diviser la chaîne de texte en un tableau en utilisant le délimiteur ";"
    $tableauProduits = explode(";", $client_buyed);
	$cpt = 0;
	
    // Parcours du tableau pour obtenir les chaînes de chiffres
    foreach($tableauProduits as $codeProduit) {
		$cpt = $cpt + 1;
		/*if($codeProduit != null)*/
			if(strlen($codeProduit) == 13) {
				try {$requete = $bdd->query("SELECT * FROM stock WHERE code_EAN13='".$codeProduit."'");}
				catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
				if($requete->rowCount() > 0) {
					$data = $requete->fetch();
					if($data['qte_stock'] <= 0){die('Erreur : plus aucun '.$data['nom_produit'].' n\'existe dans la base. Veuillez réessayer.');}
					else {
						try {$requete = $bdd->query("UPDATE `stock` SET `qte_stock`='".$data['qte_stock']-1.0."' WHERE code_EAN13='".$codeProduit."'");}
						catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
						if($handle != null){fwrite($handle, $data['nom_produit']."\n");}
					}
				}
			}
				/*else {
					try {$requete = $bdd->query("INSERT INTO `stock` (`nom_produit`, `code_EAN13`, `image`, `qte_stock`) VALUES ('".$_POST['nom_produit']."', '".$_POST['code_EAN13']."', '".$_POST['image']."', '".$_POST['qte_ajout']."')");}
					catch (Exception $error) {die('Erreur de la base SQL : ' . $error->getMessage());}
					if($error == 0) {
						header('Location:index.php?done&ticket_num='.$data['id']);
					}
				}*/
			else {
				die ('Erreur : le code scanné en position '.$cpt.' n\'est pas valide.');
			}
	}
	$requete->closeCursor();
	if($handle != null){fclose($handle);}
	
	// Génération du QR Code correspondant du fichier texte
	$fichierTexte = "tickets/".$id_actuel.".txt";
	$texte = file_get_contents($fichierTexte);
	$imagePath = "tickets/".$id_actuel.".png";
	QRcode::png($texte, $imagePath, 'L', 10, 2);
	
	if($id_actuel == 0){header('Location:index.php?done');}
	else {header('Location:index.php?done&ticket='.$id_actuel.'');}
}
else {
	header('Location:index.php?no_items');
}
?>

<!DOCTYPE HTML>
<head>
	<title>TP Identification</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>