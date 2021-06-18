window.onload = add_pourcent();

// todo get_%
// todo call add_pourcent
// todo note_finale = add_pourcent(%)


function add_pourcent(){
    var table = document.getElementById("id_table");
    var quota = 0, note_finale = 0, pourcentage;
    
    quota = get_pourcent_require(table);
    
    //! get_pourcentage
    pourcentage = 30;

    if (pourcentage > quota)
        //! ID EN DUR
        note_finale = bonus(table, 1, pourcentage, quota);
    else if (pourcentage < quota)
        //! ID EN DUR
        note_finale = malus(table, 1, pourcentage, quota);
    else
        //! ID EN DUR
        note_finale = get_note_finale(table, 1);

    document.getElementById("note_finale").innerHTML = note_finale;
}


function get_pourcent_require(table){
    var quota = 0;
    quota = table.tBodies[0].rows.length;
    return 100 / quota;
}

function get_note_finale(table, id){
    var note = 0;

    if (table){
        for(var i=1; i<4; i++){
            note += parseFloat(table.rows[id].cells[i].innerHTML);
        }
    }
    return parseFloat( (note/3).toFixed(2) );
}

function bonus(table, id, pourcentage, quota){
    var note = 0;
    var bonus = 0.5 * ((Math.floor((pourcentage - quota)/5)) +1);

    if (table){
        for(var i=1; i<4; i++){
            note += parseFloat(table.rows[id].cells[i].innerHTML);
        }
    }
    return parseFloat( ((note + bonus)/3).toFixed(2) );
}

function malus(table, id, pourcentage, quota){
    return (parseFloat(table.rows[id].cells[1].innerHTML) +
        ( parseFloat(table.rows[id].cells[2].innerHTML) + parseFloat(table.rows[id].cells[3].innerHTML))
        * pourcentage / quota) / 3;
}