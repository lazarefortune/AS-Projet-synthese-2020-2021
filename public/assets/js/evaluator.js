// Page Nav Script
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle='tab']", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    let anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

// Show/hide Form Password
var togglePassword = document.querySelectorAll('.togglePassword');
togglePassword.forEach(item => {
    item.addEventListener('click', function (e) {
        var password = item.nextElementSibling;
        var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
});

//Modal Form
$(document).ready(function() {
    $('a.update').click(function () {
//On initialise les modales materialize
        $('#update').modal();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            //on injecte le html dans la modale
            $('#update-form').html(data);
            //on ouvre la modale
            $('#update').modal('show');
        });
    });
    $('button.delete').click(function(e){
        var deleteUrl = $(this).attr('href');
        $.ajax({
        type: "POST",
        url: deleteUrl,
        });
    });
});

/*
//Searchbar
$(document).ready(function() {
    $('#table-search').keyup(function() {
        var user = $(this).val();
        if(user != "") {
            $.ajax({
                type: 'GET',
                data: encodeURIComponent(user),
                success: function(data) {
                    console.log(data);
                }
            })
        }
    });
});*/

