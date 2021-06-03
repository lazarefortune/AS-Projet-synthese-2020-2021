function moyenne(){  
    
    var rapport = parseFloat(document.getElementById("notes_rapport_1").value);
    var travail = parseFloat(document.getElementById("notes_travail_1").value);
    var competences = parseFloat(document.getElementById("notes_competences_1").value);
    var pourcent = document.getElementById("notes_pourcentage_1");
    if(pourcent){
        var pourcentage= parseFloat(pourcent.value);
    }
    var n = 0;
    var somme=0;

    
    if(isNaN(rapport))
        rapport = 0;
    else 
        n += 1;
    
    if(isNaN(travail))
        travail = 0;
    else 
        n += 1;
    
    if(isNaN(competences))
        competences = 0;
    else 
        n += 1;
    
    if(isNaN(pourcentage))
        pourcentage = 0;
    else 
        n += 1;
    
    
    somme += rapport;
    somme += travail;
    somme += competences;
    // somme += (pourcentage/5);

    var resultat = somme/n;
    console.log(typeof n, " n =", n);
    console.log(typeof rapport, "=", rapport);
    console.log(typeof travail, "=", travail);
    console.log(typeof competences, "=", competences);
    console.log(typeof resultat, "resultat =", resultat);
    
    document.getElementById("moyenne").innerHTML = resultat;
}