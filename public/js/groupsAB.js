
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
   table.innerHTML += "<tr>"+row.innerHTML+"<td><button>up</button><button>down</button></td><td><button>-</button></td></tr>";
   removefromlist(id);
}

function removefromlist(id){
   document.getElementById(id).remove();
}