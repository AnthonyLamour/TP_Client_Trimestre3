<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta charset="utf-8" />
    <!--titre de la page-->
    <title>Modification Client</title>
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
        <a href="Ajouter-Clients" class="navLink" >Ajout clients</a><br/>
        <a href="Suppression-Clients" class="navLink" >Suppression clients</a><br/>
    </nav>
    
    <!--titre principal de la page-->
    <h1>Modifier un client de la liste des clients</h1>

    <!--Contenu de la page-->
    <fieldset id="ModifierClientContenu">
        <!--légende du Formulaire-->
		<legend>
            Formulaire de choix de client
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
            <input type="button" id="Envoi" value="Valider" onclick="ChoseClient()" />
        </form>
    </fieldset>
    <br/>
    
    <div id="DivFormulaireModification">
        
    </div>
    <br/>
    <!--Contenu de la page-->
    <div id="ClientTable">
    
    </div>

    <script>
        MainContent=document.getElementById("ClientTable");
        DivFormulaireModification = document.getElementById("DivFormulaireModification");
        var clientAModifier;
        function ChoseClient(){
            //reset du div de résultat
            MainContent.innerHTML="";
            DivFormulaireModification.innerHTML="";
            //convertion de l'objet JSON en chaine pour le passer en paramètre
			var dbParam = document.getElementById("SelectedClient").value;
			clientAModifier = document.getElementById("SelectedClient").value;
            //création d'une requête XMLHttpRequest
            var xhttpC = new XMLHttpRequest();
			//lorsque la requête est envoyé
            xhttpC.onreadystatechange = function () {
                 //si la requête est prête
                 if (this.readyState == 4 && this.status == 200) {
                    //récupération et parsage du résultat en JSON avec suppression des caractères vide correspondant à la validation de l'envoie
					var i=0;
					while(this.responseText[i]!="[")
					{
						i++;
					}
                    var json = JSON.parse(this.responseText.substring(i));
                    //création d'un nouveau formulaire
                    var newFieldset = document.createElement("fieldset");
                    newFieldset.setAttribute("id","ModifierClientContenuSub");
                    var newForm = document.createElement("form");

					newInput=document.createElement("input");
                    newInput.setAttribute("type","hidden");
                    newInput.setAttribute("id","NCLI");
                    newInput.setAttribute("value",clientAModifier);
                    newForm.appendChild(newInput);

                    newLabel = document.createElement("label");
                    newLabel.setAttribute("for","NOM");
                    newLabel.innerHTML="Nom :";
                    newForm.appendChild(newLabel);
                    newSpan = document.createElement("span");
                    newSpan.setAttribute("id","MessageErreurNOM");
                    newSpan.setAttribute("class","MessageErreur");
                    newForm.appendChild(newSpan);
					newSpan = document.createElement("span");
                    newSpan.setAttribute("id","MessageErreurNCLI");
                    newSpan.setAttribute("class","MessageErreur");
                    newForm.appendChild(newSpan);
                    newInput=document.createElement("input");
                    newInput.setAttribute("type","text");
                    newInput.setAttribute("id","NOM");
                    newInput.setAttribute("placeholder","Nom");
                    newInput.setAttribute("value",json[0].NOM);
                    newForm.appendChild(newInput);
                    
                    newLabel = document.createElement("label");
                    newLabel.setAttribute("for","ADRESSE");
                    newLabel.innerHTML="Adresse :";
                    newForm.appendChild(newLabel);
                    newSpan = document.createElement("span");
                    newSpan.setAttribute("id","MessageErreurADRESSE");
                    newSpan.setAttribute("class","MessageErreur");
                    newForm.appendChild(newSpan);
                    newInput=document.createElement("input");
                    newInput.setAttribute("type","text");
                    newInput.setAttribute("id","ADRESSE");
                    newInput.setAttribute("placeholder","4 rue exemple");
                    newInput.setAttribute("value",json[0].ADRESSE);
                    newForm.appendChild(newInput);
                    
                    newLabel = document.createElement("label");
                    newLabel.setAttribute("for","LOCALITE");
                    newLabel.innerHTML="Localité :";
                    newForm.appendChild(newLabel);
                    newSpan = document.createElement("span");
                    newSpan.setAttribute("id","MessageErreurLOCALITE");
                    newSpan.setAttribute("class","MessageErreur");
                    newForm.appendChild(newSpan);
                    newInput=document.createElement("input");
                    newInput.setAttribute("type","text");
                    newInput.setAttribute("id","LOCALITE");
                    newInput.setAttribute("placeholder","Paris");
                    newInput.setAttribute("value",json[0].LOCALITE);
                    newForm.appendChild(newInput);
                    
                    newLabel = document.createElement("label");
                    newLabel.setAttribute("for","CATEGORIE");
                    newLabel.innerHTML="Catégorie :";
                    newForm.appendChild(newLabel);
                    newInput=document.createElement("select");
                    newInput.setAttribute("id","CATEGORIE");
                    var newOption = document.createElement("option");
                    newOption.setAttribute("value",json[0].CATEGORIE);
                    if(json[0].CATEGORIE == "A"){
                        newOption.innerHTML="A";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","NULL");
                        newOption.innerHTML="Aucune";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","B");
                        newOption.innerHTML="B";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","C");
                        newOption.innerHTML="C";
                        newInput.appendChild(newOption);
                    }else if(json[0].CATEGORIE == "B"){
                        newOption.innerHTML="B";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","NULL");
                        newOption.innerHTML="Aucune";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","A");
                        newOption.innerHTML="A";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","C");
                        newOption.innerHTML="C";
                        newInput.appendChild(newOption);
                    }else if(json[0].CATEGORIE == "C"){
                        newOption.innerHTML="C";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","NULL");
                        newOption.innerHTML="Aucune";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","A");
                        newOption.innerHTML="A";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","B");
                        newOption.innerHTML="B";
                        newInput.appendChild(newOption);
                    }else{
                        newOption.setAttribute("value","NULL");
                        newOption.innerHTML="Aucune";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","A");
                        newOption.innerHTML="A";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","B");
                        newOption.innerHTML="B";
                        newInput.appendChild(newOption);
                        newOption = document.createElement("option");
                        newOption.setAttribute("value","C");
                        newOption.innerHTML="C";
                        newInput.appendChild(newOption);
                    }
                    newForm.appendChild(newInput);
                    
                    newLabel = document.createElement("label");
                    newLabel.setAttribute("for","COMPTE");
                    newLabel.innerHTML="Compte :";
                    newForm.appendChild(newLabel);
                    newSpan = document.createElement("span");
                    newSpan.setAttribute("id","MessageErreurCOMPTE");
                    newSpan.setAttribute("class","MessageErreur");
                    newForm.appendChild(newSpan);
                    newInput=document.createElement("input");
                    newInput.setAttribute("type","number");
                    newInput.setAttribute("id","COMPTE");
                    newInput.setAttribute("placeholder","00");
                    newInput.setAttribute("value",json[0].COMPTE);
                    newForm.appendChild(newInput);

                    newInput=document.createElement("input");
                    newInput.setAttribute("type","button");
                    newInput.setAttribute("id","ValideButton");
                    newInput.setAttribute("value","Valider");
                    newInput.setAttribute("onclick","ModifierUnClient()");
                    newForm.appendChild(newInput);
                    
                    newFieldset.appendChild(newForm);
                    DivFormulaireModification.appendChild(newFieldset);
                 }
            }
            xhttpC.open("GET", "PHP/RecupererUnClient.php?id=" + dbParam, true);
            //envoi de la requète
            xhttpC.send();
        }
        function ModifierUnClient(){
            //création du message de confirmation
            var msg = 'Voulez vous vraiment modifier le client :'+document.getElementById("SelectedClient").options[document.getElementById("SelectedClient").selectedIndex].text;
            if (confirm(msg) ){
                if(VerifFormulaireAjout()){
                    //reset du div de résultat
                    MainContent.innerHTML="";
			        //création d'un nouveau tableau HTML
                    var newTable = document.createElement("table");
			        //création de l'objet JSON
                    var ClientJSONObj={"NCLI": clientAModifier,
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
                    xhttp.open("GET", "PHP/ModifierUnClient.php?client=" + dbParam, true);
                    //envoi de la requète
                    xhttp.send();
                }
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