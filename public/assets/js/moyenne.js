function moyenne(id){  
    // var id = document.querySelector('#notes_rapport').data.id;
    console.log("id : ", id);
    var rapport = parseFloat(document.getElementById("notes_rapport_"+id).value);
    var travail = parseFloat(document.getElementById("notes_travail_"+id).value);
    var competences = parseFloat(document.getElementById("notes_competences_"+id).value);
    var pourcent = document.getElementById("notes_pourcentage_"+id);
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
    resultat = parseFloat(resultat).toFixed(2);
    console.log(typeof n, " n =", n);
    console.log(typeof rapport, "=", rapport);
    console.log(typeof travail, "=", travail);
    console.log(typeof competences, "=", competences);
    console.log(typeof resultat, "resultat =", resultat);
    
    document.getElementById("moyenne_"+id).innerHTML = resultat;
    
}