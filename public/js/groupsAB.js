
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
   let new_row_id= id + "_main";
   table.innerHTML += "<tr>"+row.innerHTML +"<td><button type=\"button\" onclick=\"moveUp(this.parentElement.parentElement);\" >up</button><button type=\"button\" onclick=\"moveDown(this.parentElement.parentElement);\" >down</button></td><td><button type=\"button\" onclick='deleteLine(this.parentElement.parentElement)' >-</button></td></tr>";
   table.lastElementChild.id=new_row_id;
   removefromlist(id);
}

function removefromlist(id){
   document.getElementById(id).remove();
}

function moveUp(line){

}
function moveDown(line){

}

function deleteLine(line){
   let counter = 0;
   let tbody=document.getElementById('bud');
   let new_row = tbody.insertRow(-1);
    let new_id = line.id.substring(0,line.id.length-5);
   new_row.id = new_id;
   console.log(new_row.id+" = "+line.id);
   new_row.setAttribute("data-dest","");
   new_row.classList.add("row-set");
   $(line.children).each(function(){
      if(counter<3){
         let cell = new_row.insertCell(-1);
         cell.innerHTML = this.parentElement.children[counter].innerHTML
         counter++;
      }
   });
   console.log(new_row);
   tbody.insertRow(new_row);
   let row = document.getElementById(new_id);
   console.log(row.id);
   removefromlist(line.id);
   row.onclick = addtolist(row.id);
}


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
