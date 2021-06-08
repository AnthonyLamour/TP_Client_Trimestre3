﻿<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta charset="utf-8" />
    <!--titre de la page-->
    <title>Récup client</title>
    <!--lien vers le CSS de la page-->
    <link rel="stylesheet" href="../CSS/Style.css" />
    <!--icone de la page-->
    <link rel="icon" href="../Images/icon.png">
</head>

<!--contenu de la page-->
<body>

    <nav>
        <h3>Menu de navigation :</h3>
        <a href="accueil" class="navLink" >Accueil</a><br/>
        <a href="Ajouter-Clients" class="navLink" >Ajout clients</a><br/>
        <a href="Suppression-Clients" class="navLink" >Suppression clients</a><br/>
        <a href="Modifier-Clients" class="navLink" >Modification clients</a><br/>
    </nav>
    
    <!--titre principal de la page-->
    <h1>Récupération de la liste des clients</h1>

    <!--Contenu de la page-->
    <div id="ClientTable">
        <!--php-->
        <?php
            //connexion à la BDD grâce au fichier BDDconnect
            include 'BDDConnect.php';
            //importation de la class Client
            include_once 'ClassClient.php';
			//importation de la class Gestion de fichier temporaire
			include 'ClassGestionFichierTmp.php';
            //récupération de tout les client de la base
            $sql = "SELECT * FROM CLIENT";
            //création d'un tableau
            echo "<table>";
            //création des titres du tableau
            echo "<tr>";
            echo '<th scope="col" class="TextCadre">Numéro de client</th>';
            echo '<th scope="col" class="TextCadre">Nom</th>';
            echo '<th scope="col" class="TextCadre">Adresse</th>';
            echo '<th scope="col" class="TextCadre">Localité</th>';
            echo '<th scope="col" class="TextCadre">Catégorie</th>';
            echo '<th scope="col" class="TextCadre">Compte</th>';
            //pour chaque résultat de la requête sql
            foreach($conn->query($sql) as $newClient){
                //création d'un nouvel objet Client
			    $currentClient = new Client();
                //initialisation du nouveau client
                $currentClient->Init_CLIENT($newClient["NCLI"],$newClient["NOM"],$newClient["ADRESSE"],$newClient["LOCALITE"],$newClient["CATEGORIE"],$newClient["COMPTE"]);
                //création de la ligne correspondant au nouveau client dans le tableau
                echo "<tr>";
                echo '<td class="TextCadre">'.$currentClient->Get_NCLI()."</td>";
                echo '<td class="TextCadre">'.$currentClient->Get_NOM()."</td>";
                echo '<td class="TextCadre">'.$currentClient->Get_ADRESSE()."</td>";
                echo '<td class="TextCadre">'.$currentClient->Get_LOCALITE()."</td>";
                echo '<td class="TextCadre">'.$currentClient->Get_CATEGORIE()."</td>";
                echo '<td class="TextCadre">'.$currentClient->Get_COMPTE()."</td>";
                echo "</tr>";
            }
            //fermeture du tableau
            echo"</table>";
			$GFichierTmp = new GestionFichierTmp();
			$GFichierTmp->UpdateTmpFile("Read");
        ?>
    </div>

    <!--footer-->
    <footer>
        <!--paragraphe de footer-->
        <p>Anthony LAMOUR étudiant en Master 2 à Ludus Académie</p>
    </footer>
</body>

</html>