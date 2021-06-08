<?php

    //connexion à la BDD grâce au fichier BDDconnect
    include 'BDDConnect.php';
	//importation de la class Gestion de fichier temporaire
	include 'ClassGestionFichierTmp.php';

    //récupération et parsage de l'objet JSON
    $obj = json_decode($_GET["client"], false);

    //création de la requête sql
    if($obj->CATEGORIE=="NULL"){
        $sql='UPDATE CLIENT 
              SET NCLI ="'.$obj->NCLI.'", NOM ="'.$obj->NOM.'", ADRESSE = "'.$obj->ADRESSE.'", LOCALITE="'.$obj->LOCALITE.'", CATEGORIE='.$obj->CATEGORIE.',COMPTE='.$obj->COMPTE.' 
              WHERE NCLI="'.$obj->NCLI.'";';
    }else{
        $sql='UPDATE CLIENT 
              SET NCLI ="'.$obj->NCLI.'", NOM ="'.$obj->NOM.'", ADRESSE = "'.$obj->ADRESSE.'", LOCALITE="'.$obj->LOCALITE.'", CATEGORIE="'.$obj->CATEGORIE.'",COMPTE='.$obj->COMPTE.' 
              WHERE NCLI="'.$obj->NCLI.'";';
    }
    $conn->query($sql);
	if($conn->errorInfo()[0]!=0000)
	{
		echo json_encode($conn->errorInfo());
	}
	else
	{
		//récupération du client modifié
		$sql = 'SELECT * FROM CLIENT WHERE NCLI="'.$obj->NCLI.'";';
		//pour chaque résultat de la requête sql
		foreach($conn->query($sql) as $newClient){
			//création d'un nouvel objet Client
			$currentClient = new Client();
			//initialisation du nouveau client
			$currentClient->Init_CLIENT($newClient["NCLI"],$newClient["NOM"],$newClient["ADRESSE"],$newClient["LOCALITE"],$newClient["CATEGORIE"],$newClient["COMPTE"]);
		}

		//récupération de tout les clients de la base
		$sql = $conn->prepare("SELECT * FROM CLIENT ORDER BY NCLI DESC");
		//exécution de la requête sql
		$sql->execute();
		//récupération du résultat de la requête sql
		$clients = $sql->fetchAll();

		$GFichierTmp = new GestionFichierTmp();
		$GFichierTmp->UpdateTmpFile("Update",$currentClient);

		//renvoi du résultat sous forme d'objet JSON
		echo json_encode($clients);
	}
	
?>