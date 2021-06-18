var list_title = [];

window.onload = function(){
    list_title = document.getElementsByTagName("h6");
}

function findItem(){
    let input = document.getElementById('input_search').value;

    for (var i=0; i<list_title.length; i++){
        if (input =='')
            list_title[i].parentNode.setAttribute("style","display: inline-block");
        if (list_title[i].textContent.indexOf(input) != -1)
            list_title[i].parentNode.setAttribute("style","display: inline-block");
        else
            list_title[i].parentNode.setAttribute("style","display: none");
    }
};