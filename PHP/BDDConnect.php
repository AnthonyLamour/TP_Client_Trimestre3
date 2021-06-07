<?php

	//include du fichier de constantes
    include 'Constantes.php';

	//fonction permettant la connexion
	function ConnecServ(){
			
		//mise en place du script de connexion
			$dsn="mysql:dbname=".BASE.";host=".SERVEUR;
			
		//tentative de connexion à la base de données
			try{
				$connexion=new PDO($dsn,USER,PASSWD);
				$connexion->exec("set names utf8");
			}
			
		//affichage d'éventuelles erreurs
			catch(PDOExecption $e){
				printf("Echec de la connexion : %s\n", $e->getMessage());
				exit();
			}
			
		//renvoi de la connexion
			return $connexion;
	}
	//connexion à la BDD
	$conn = ConnecServ();
?>