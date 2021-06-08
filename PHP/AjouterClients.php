<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta charset="utf-8" />
    <!--titre de la page-->
    <title>Ajout Client</title>
    <!--lien vers le CSS de la page-->
    <link rel="stylesheet" href="../CSS/Style.css" />
    <!--icone de la page-->
    <link rel="icon" href="../Images/icon.png">
    <!--lien vers le fichier js de vérification de formulaires-->
    <script type="text/javascript" src="../JS/VerificationFromulaires.js" charset="utf-8"></script>
	<!--lien vers le fichier js de vérification de formulaires-->
    <script type="text/javascript" src="../JS/AffichageDeLaListeDeClient.js" charset="utf-8"></script>
</head>

<!--contenu de la page-->
<body>

    <nav>
        <h3>Menu de navigation :</h3>
        <a href="accueil" class="navLink" >Accueil</a><br/>
        <a href="Liste-De-Clients" class="navLink" >Récupération clients</a><br/>
        <a href="Suppression-Clients" class="navLink" >Suppression clients</a><br/>
        <a href="Modifier-Clients" class="navLink" >Modification clients</a><br/>
    </nav>
    
    <!--titre principal de la page-->
    <h1>Ajouter un client à la liste des clients</h1>

    <!--Contenu de la page-->
    <fieldset id="AjoutClientContenu">
        <!--légende du formulaire-->
        <legend>
            Formulaire d'ajout
        </legend>
        <!--Formulaire de la page-->
        <form id="MainFormulaire">
            <!--label de l'input NCLI-->
            <label for="NCLI">Numéro de client :</label><span id="MessageErreurNCLI" class="MessageErreur"></span>
            <!--input NCLI-->
            <input type="text" id="NCLI" placeholder="A000" required/>
            <!--label de l'input NOM-->
            <label for="NOM">Nom :</label><span id="MessageErreurNOM" class="MessageErreur"></span>
            <!--input NOM-->
            <input type="text" id="NOM" placeholder="Nom" required/>
            <!--label de l'input ADRESSE-->
            <label for="ADRESSE">Adresse :</label><span id="MessageErreurADRESSE" class="MessageErreur"></span>
            <!--input ADRESSE-->
            <input type="text" id="ADRESSE" placeholder="4 rue Exemple" required/>
            <!--label de l'input LOCALITE-->
            <label for="LOCALITE">Localité :</label><span id="MessageErreurLOCALITE" class="MessageErreur"></span>
            <!--input LOCALITE-->
            <input type="text" id="LOCALITE" placeholder="Paris" required/>
            <!--label de l'input CATEGORIE-->
            <label for="CATEGORIE">Catégorie :</label>
            <!--input CATEGORIE-->
            <select id="CATEGORIE">
                <option value="NULL">Aucune</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <!--label de l'input COMPTE-->
            <label for="COMPTE">Compte :</label><span id="MessageErreurCOMPTE" class="MessageErreur"></span>
            <!--input COMPTE-->
            <input type="number" id="COMPTE" placeholder="00" required/>
            <!--bouton de validation du formulaire-->
            <input type="button" id="ValideButton" value="Valider" onclick="AjouterUnClient()"/>
        </form>
    </fieldset>
    <br/>
    <!--Contenu de la page-->
    <div id="ClientTable">
    
    </div>
    
    <script>
        MainContent=document.getElementById("ClientTable");
        function AjouterUnClient(){
            if(VerifFormulaireAjout()){
                //reset du div de résultat
                MainContent.innerHTML="";
			    //création d'un nouveau tableau HTML
                var newTable = document.createElement("table");
			    //création de l'objet JSON
                var ClientJSONObj={"NCLI": document.getElementById("NCLI").value,
                                   "NOM": document.getElementById("NOM").value,
                                   "ADRESSE": document.getElementById("ADRESSE").value,
                                   "LOCALITE": document.getElementById("LOCALITE").value,
                                   "CATEGORIE": document.getElementById("CATEGORIE").value,
                                   "COMPTE": document.getElementById("COMPTE").value};
                //convertion de l'objet JSON en chaine pour le passer en paramètre
			    var dbParam = JSON.stringify(ClientJSONObj);
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
                xhttp.open("GET", "PHP/AjouterUnClient.php?client=" + dbParam, true);
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