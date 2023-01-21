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
elseif($op == "calcule")
{
    $req=$bdd->query('SELECT COUNT(*) as isa,SUM((taux*nbheure)) as salaire,entreprise.numero as numero, entreprise.design as nom FROM employes,travail,entreprise where employes.numero=travail.numero_employe AND travail.numero_entreprise=entreprise.numero AND entreprise.id='.$_POST["id"]);

	$reponse = $req->fetch();

	echo json_encode($reponse);
}
elseif($op == "ajout_employe")
{
	$req=$bdd->prepare('INSERT INTO employes VALUES(0,"'.$_POST["numero"].'","'.$_POST["nom"].'","'.$_POST["adresse"].'")');

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}

elseif($op == "ajout_entr")
{
	$req=$bdd->prepare('INSERT INTO entreprise VALUES(0,"'.$_POST["numero_entr"].'","'.$_POST["design"].'")');

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}

elseif($op == "ajout_trav")
{
	$req=$bdd->prepare('INSERT INTO travail VALUES(0,"'.$_POST["numero_empT"].'","'.$_POST["numero_entrT"].'","'.$_POST["date"].'","'.$_POST["nb_heure"].'","'.$_POST["taux"].'")');

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}

//modification employe, afffichagen'le zavatra ovaina
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
//fin affichage sy modif employe

//entreprise modif
elseif($op == "modif_entr")
{
	$req=$bdd->prepare('UPDATE entreprise SET numero="'.$_POST["numero"].'",design="'.$_POST["design"].'" where id='.$_POST["id"]);

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}
elseif($op == "affiche_entr")
{
	$req=$bdd->query('SELECT * FROM entreprise where id='.$_POST["id"]);

	$reponse = $req->fetch();

	echo json_encode($reponse);

}
//fin modif entreprise

//travail modif
elseif($op == "modif_trav")
{
	$req=$bdd->prepare('UPDATE travail SET numero_employe="'.$_POST["numero_employe"].'",numero_entreprise="'.$_POST["numero_entreprise"].'",date="'.$_POST["date"].'",nbheure="'.$_POST["nbheure"].'",taux="'.$_POST["taux"].'" where id='.$_POST["id"]);

	 $req->execute();
$reponse["succes"]= "succes";
	echo json_encode($reponse);

}
elseif($op == "affiche_trav")
{
	$req=$bdd->query('SELECT * FROM travail where id='.$_POST["id"]);

	$reponse = $req->fetch();

	echo json_encode($reponse);

}
//fin modif travail


elseif($op == "search")
{
	$req=$bdd->query('SELECT * FROM employes where id="'.$_POST["search"].'" OR nom like "%'.$_POST["search"].'%" OR adresse like "%'.$_POST["search"].'%" OR numero like "%'.$_POST["search"].'%"');

	$reponse = $req->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($reponse);
}


//suppression global izy reetra
elseif($op == "fafana")
{
	$type = $_POST['type'];
	if($type == "emp") {
		$req=$bdd->prepare('DELETE FROM employes where id='.$_POST["id"]);
	 	$req->execute();
		$reponse["succes"]= "succes";
	echo json_encode($reponse);
	}
	elseif($type=="entr") {
		$req=$bdd->prepare('DELETE FROM entreprise where id='.$_POST["id"]);
	 	$req->execute();
		$reponse["succes"]= "succes";
	echo json_encode($reponse);

	}
	else {
		$req=$bdd->prepare('DELETE FROM travail where id='.$_POST["id"]);
	 	$req->execute();
		$reponse["succes"]= "succes";
	echo json_encode($reponse);

	}
}
// fin suppression


?>