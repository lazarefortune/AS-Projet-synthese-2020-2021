
$(".btn-modal").click(function(){
   console.log("hello there");
   let crenau_id = this.parentElement.parentElement.id;
   console.log(crenau_id);
   $(".row-set").each(function (){
      this.setAttribute("data-dest",crenau_id);
   });
});


function addtolist(id){
   let row = document.getElementById(id);
   let table = document.getElementById(row.getAttribute("data-dest")).lastElementChild;
   table.innerHTML += "<tr>"+row.innerHTML +"<td><button type=\"button\" onclick=\"move(this,'up');\" >up</button><button type=\"button\" onclick=\"move(this,'down');\" >down</button></td><td><button type=\"button\" onclick='suppression(this)' >-</button></td></tr>";
   removefromlist(id);
}

function removefromlist(id){
   document.getElementById(id).remove();
}

/*
function deplacerLigne(inputObj, cible)
{
   //on initialise nos variables
   var ligne = document.getElementById("bud").rows[inputObj];//on copie la ligne
   var nouvelle = document.getElementById("bud").insertRow(cible);//on insère la nouvelle ligne
   var cellules = ligne.cells;

   //on boucle pour pouvoir agir sur chaque cellule
   for(var i=0; i<cellules.length; i++)
   {
      nouvelle.insertCell(-1).innerHTML += cellules[i].innerHTML;//on copie chaque cellule de l'ancienne à la nouvelle ligne
   }

   //on supprimer l'ancienne ligne
   document.getElementById("tableau").deleteRow(ligne.rowIndex);//on met ligne.rowIndex et non pas source car le numéro d'index a pu changer
}
*/

function move(inputObj,direction){
   let tr=inputObj.parentElement.parentElement,
       tbody=document.getElementById('bud'),
       trs=tbody.getElementsByTagName('tr'),

       count=trs.length,
       i=0,
       tr2,
       found=false;
   direction=(direction && (direction==='up' || direction==='down'))?direction:'up';
   console.log(tbody);

   while(i<count && !found){
      if(trs[i]===tr){
         found=true;
      }else{
         i++;
      }
   }
   if((i!==0 && direction==='up') || (i!==count-1 && direction==='down')){
      tbody.lastChild.remove();
      tr2=(direction==='up')?tbody.insertRow(i-1):tbody.insertRow(i+1);
      tbody.replaceChild(tr,tr2);
   }
}


function suppression(inputObj)
{
   let tr=inputObj.parentElement.parentElement,
       tbody=document.getElementById('bud');

   tbody.deleteRow(tr);

}

/*
function deplaceLigne(oEvent){
   var oBt = oEvent.currentTarget,
       bUp  = oBt.classList.contains('bt-up'),
       oTd = getParentBy(oBt, 'td'),
       oTr,
       oTableSection,
       oTable,
       bBoucle=false,
       iRowIndex,
       iIndexRef,
       iIndexNew;
   if(oTd != null){
      oTr = oTd.parentNode;
      oTableSection = oTr.parentNode;
      oTable= oTableSection.parentNode;
      bBoucle = !oTable.classList.contains("noboucle");
      iRowIndex  = oTr.sectionRowIndex;
      iIndexRef = iRowIndex + (bUp === true? -1:0);
      iIndexNew = iRowIndex + (bUp === true? 0:1);

      if(bUp === true && iIndexRef < 0){
         if(bBoucle === false){
            //si on ne met pas de return la ligne est mise à la fin
            return false;
         }//if
      } else if(bUp === false && iIndexNew >= oTableSection.rows.length){
         if(bBoucle === false){
            //si on ne met pas de return la ligne est mise à la fin
            return false;
         }else{
            //si on ne met pas de return la ligne reste à la fin
            // pour qu'elle vienne au debut
            iIndexRef = 0;
            iIndexNew = oTableSection.rows.length - 1;
         }//else
      } //else if
      oTableSection.insertBefore(oTableSection.rows[iIndexNew],oTableSection.rows[iIndexRef]);
   }//if
}//fct
*/
