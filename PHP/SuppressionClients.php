<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta charset="utf-8" />
    <!--titre de la page-->
    <title>Suppression Client</title>
    <!--lien vers le CSS de la page-->
    <link rel="stylesheet" href="../CSS/Style.css" />
    <!--icone de la page-->
    <link rel="icon" href="../Images/icon.png">
	<!--lien vers le fichier js de vérification de formulaires-->
    <script type="text/javascript" src="../JS/AffichageDeLaListeDeClient.js" charset="utf-8"></script>
</head>

<!--contenu de la page-->
<body>

    <nav>
        <h3>Menu de navigation :</h3>
        <a href="accueil" class="navLink" >Accueil</a><br/>
        <a href="Liste-De-Clients" class="navLink" >Récupération clients</a><br/>
        <a href="Ajouter-Clients" class="navLink" >Ajout clients</a><br/>
        <a href="Modifier-Clients" class="navLink" >Modification clients</a><br/>
    </nav>
    
    <!--titre principal de la page-->
    <h1>Supprimer un client de la liste des clients</h1>

    <!--Contenu de la page-->
    <fieldset id="SuppressionClientContenu">
        <!--légende du Formulaire-->
		<legend>
            Formulaire de suppression
        </legend>
		<!--Formulaire de la page-->
        <form id="MainFormulaire">
			<!--label du select de client-->
            <label for="SelectedClient">Choisissez un client :</label>
			<!--select de client-->
            <select id="SelectedClient">
                <?php
                    //connexion à la BDD grâce au fichier BDDconnect
                    include 'BDDConnect.php';
					//création de la requête sql permettant de récupérer les armes-->
                    $sql = "SELECT * FROM CLIENT";
					//pour chaque résultat
                    foreach($conn->query($sql) as $Client){
                        //ajout d'une option du select
						echo '<option value = "'.$Client["NCLI"].'">'.$Client["NCLI"].' '.$Client["NOM"].'</option>';
                    }
                ?>
            </select>
			<!--bouton permettant de valider le Formulaire-->
            <input type="button" id="Envoi" value="Valider" onclick="SupprimerUnClient()" />
        </form>
    </fieldset>
    <br/>
    <!--Contenu de la page-->
    <div id="ClientTable">
    
    </div>

    <script>
        MainContent=document.getElementById("ClientTable");
        function SupprimerUnClient(){
            //création du message de confirmation
            var msg = 'Voulez vous vraiment supprimer le client :'+document.getElementById("SelectedClient").options[document.getElementById("SelectedClient").selectedIndex].text;
            if (confirm(msg) ){
                //reset du div de résultat
                MainContent.innerHTML="";
			    //création d'un nouveau tableau HTML
                var newTable = document.createElement("table");
                //convertion de l'objet JSON en chaine pour le passer en paramètre
			    var dbParam = document.getElementById("SelectedClient").value;
			    //création d'une requête XMLHttpRequest
                var xhttp = new XMLHttpRequest();
			    //lorsque la requête est envoyé
                xhttp.onreadystatechange = function () {
				    //si la requête est prête
                    if (this.readyState == 4 && this.status == 200) {
						//récupération et parsage du résultat en JSON avec suppression des caractères vide correspondant à la validation de l'envoie
						var i=0;
						while(this.responseText[i]!="[")
						{
							i++;
						}
						var json = JSON.parse(this.responseText.substring(i));
						if(Object.keys(json).length == 3)
						{
							//création d'une nouvelle colone du tableau
							var newError = document.createElement("p");
							//set de l'attribut class de la case
							newError.setAttribute("class", "ErrorPrint");
							//remplissage de la case
							newError.innerHTML=json[2];
							//ajout de la case dans la ligne
							MainContent.appendChild(newError);
						}
						else
						{
							AfficherLesClients(MainContent,newTable,json);
						}
                    }
                };
                //ouverture du fichier XML
                xhttp.open("GET", "PHP/SupprimerUnClient.php?id=" + dbParam, true);
                //envoi de la requète
                xhttp.send();
            }
        }
    </script>
    
    <!--footer-->
    <footer>
        <!--paragraphe de footer-->
        <p>Anthony LAMOUR étudiant en Master 2 à Ludus Académie</p>
    </footer>
</body>

</html>