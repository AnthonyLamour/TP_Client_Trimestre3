<?php

    //connexion à la BDD grâce au fichier BDDconnect
    include 'BDDConnect.php';
	//importation de la class Gestion de fichier temporaire
	include 'ClassGestionFichierTmp.php';

    //récupération et parsage de l'objet JSON
    $obj = json_decode($_GET["client"], false);
    //création de la requête sql
    if($obj->CATEGORIE=="NULL"){
        $sql='insert into CLIENT (NCLI,NOM,ADRESSE,LOCALITE,CATEGORIE,COMPTE) 
              values ("'.$obj->NCLI.'","'.$obj->NOM.'","'.$obj->ADRESSE.'","'.$obj->LOCALITE.'",'.$obj->CATEGORIE.','.$obj->COMPTE.');';
    }else{
        $sql='insert into CLIENT (NCLI,NOM,ADRESSE,LOCALITE,CATEGORIE,COMPTE) 
              values ("'.$obj->NCLI.'","'.$obj->NOM.'","'.$obj->ADRESSE.'","'.$obj->LOCALITE.'","'.$obj->CATEGORIE.'",'.$obj->COMPTE.');';
    }
    $conn->query($sql) === true;
	if($conn->errorInfo()[0]!=0000)
	{
		echo json_encode($conn->errorInfo());
	}
	else
	{
		//récupération de tout les clients de la base
		$sql = $conn->prepare("SELECT * FROM CLIENT ORDER BY NCLI DESC");
		//exécution de la requête sql
		$sql->execute();
		//récupération du résultat de la requête sql
		$clients = $sql->fetchAll();

		//initialisation du nouveau client
		$currentClient = new Client();
		$currentClient->Init_CLIENT($obj->NCLI,$obj->NOM,$obj->ADRESSE,$obj->LOCALITE,$obj->CATEGORIE,$obj->COMPTE);

		$GFichierTmp = new GestionFichierTmp();
		$GFichierTmp->UpdateTmpFile("Create",$currentClient);

		//renvoi du résultat sous forme d'objet JSON
		echo json_encode($clients);
	}
	
?>