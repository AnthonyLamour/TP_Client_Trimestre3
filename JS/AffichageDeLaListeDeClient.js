function AfficherLesClients(MainContent,newTable,json)
{
    //création d'une nouvelle ligne du tableau
    var newLine = document.createElement("tr");
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Numéro  de client";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Nom";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Adresse";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Localité";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Catégorie";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //création d'une nouvelle colone du tableau
    var newCol = document.createElement("th");
    //set de l'attribut class de la case
    newCol.setAttribute("class", "TextCadre");
    //remplissage de la case
    newCol.innerHTML = "Compte";
    //ajout de la case dans la ligne
    newLine.appendChild(newCol);
    //ajout de la ligne dans le tableau
    newTable.appendChild(newLine);
    //pour chaque élément du JSON
    for (var i = 0; i < json.length; i++) {
        //création d'une nouvelle ligne du tableau
        newLine = document.createElement("tr");
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].NCLI;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].NOM;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].ADRESSE;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].LOCALITE;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].CATEGORIE;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //création d'une nouvelle colone du tableau
        newCol = document.createElement("td");
        //set de l'attribut class de la case
        newCol.setAttribute("class", "TextCadre");
        //remplissage de la case
        newCol.innerHTML = json[i].COMPTE;
        //ajout de la case dans la ligne
        newLine.appendChild(newCol);
        //ajout de la ligne dans le tableau
        newTable.appendChild(newLine);
    }
    //ajout du tableau dans le div
    MainContent.appendChild(newTable);
}