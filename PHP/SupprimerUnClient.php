<?php

    //connexion à la BDD grâce au fichier BDDconnect
    include 'BDDConnect.php';
	//importation de la class Gestion de fichier temporaire
	include 'ClassGestionFichierTmp.php';

    //récupération de l'id du client à supprimer
    $identifiant = $_GET["id"];

	//récupération du client à supprimer
    $sql = 'SELECT * FROM CLIENT WHERE NCLI="'.$identifiant.'";';
	//pour chaque résultat de la requête sql
    foreach($conn->query($sql) as $newClient){
        //création d'un nouvel objet Client
		$currentClient = new Client();
        //initialisation du nouveau client
        $currentClient->Init_CLIENT($newClient["NCLI"],$newClient["NOM"],$newClient["ADRESSE"],$newClient["LOCALITE"],$newClient["CATEGORIE"],$newClient["COMPTE"]);
    }

    //création de la requête sql
    $sql='DELETE FROM CLIENT
          WHERE NCLI="'.$identifiant.'";';
    $conn->query($sql);
    //récupération de tout les clients de la base
    $sql = $conn->prepare("SELECT * FROM CLIENT ORDER BY NCLI DESC");
	//exécution de la requête sql
    $sql->execute();
	//récupération du résultat de la requête sql
    $clients = $sql->fetchAll();

	$GFichierTmp = new GestionFichierTmp();
	$GFichierTmp->UpdateTmpFile("Delete",$currentClient);

	//renvoi du résultat sous forme d'objet JSON
    echo json_encode($clients);
	
?>