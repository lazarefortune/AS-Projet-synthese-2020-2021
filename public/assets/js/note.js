function moyenne(){  
    
    var rapport = parseFloat(document.getElementById("notes_rapport_1").value);
    var travail = parseFloat(document.getElementById("notes_travail_1").value);
    var competences = parseFloat(document.getElementById("notes_competences_1").value);
    var pourcentage = parseFloat(document.getElementById("notes_pourcentage_1").value);
    var n = 3;
    var somme=0;

    somme += rapport;
    somme += travail;
    somme += competences;
    somme += (pourcentage/5);

    var resultat = somme/n;
    
    var moy = document.getElementById("moyenne");
    moy.innerHTML= resultat;
    
    return resultat;
}